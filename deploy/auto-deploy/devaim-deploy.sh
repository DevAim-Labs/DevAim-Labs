#!/usr/bin/env bash
#
# Auto-deploy for the DevAim Labs Droplet. Run by devaim-deploy.timer every
# 2 minutes (install: see README.md next to this file).
#
# Does nothing unless origin/main has new commits. Then: fast-forward pull,
# composer/npm install only when their lock files changed, Vite build,
# migrations only when a migration changed, Laravel caches, PHP-FPM reload.
# If any step fails, it rolls back to the previous commit and rebuilds.
#
# Installed as /usr/local/bin/devaim-deploy (a copy, so a pull can never
# rewrite the script while it runs).

set -Eeuo pipefail   # -E: the ERR trap (rollback) also fires inside functions

APP="${APP_DIR:-/var/www/devaimlabs}"
BRANCH="${DEPLOY_BRANCH:-main}"
PHP_FPM="${PHP_FPM_SERVICE:-php8.3-fpm}"

# One deploy at a time; a run that overlaps a slow build just skips.
exec 9>/run/lock/devaim-deploy.lock
flock -n 9 || exit 0

log() { echo "[devaim-deploy] $*"; }

cd "$APP"

# Run app commands as the owner of the project folder (not root), so file
# ownership in storage/, bootstrap/cache/ and public/build/ stays correct.
OWNER="$(stat -c %U "$APP")"
# npm and composer need a writable home for their caches; www-data's home
# (/var/www) usually isn't, so give the owner a private one.
DEPLOY_HOME=/var/tmp/devaim-deploy-home
install -d -o "$OWNER" -m 700 "$DEPLOY_HOME"
as_owner() {
    if [ "$(id -un)" = "$OWNER" ]; then
        HOME="$DEPLOY_HOME" "$@"
    else
        runuser -u "$OWNER" -- env HOME="$DEPLOY_HOME" PATH="$PATH" "$@"
    fi
}

as_owner git fetch --quiet origin "$BRANCH"
OLD="$(as_owner git rev-parse HEAD)"
NEW="$(as_owner git rev-parse "origin/$BRANCH")"
[ "$OLD" = "$NEW" ] && exit 0

# A commit that already failed is not retried every 2 minutes (each retry
# would briefly put unbuilt code live); the next push gets a fresh attempt.
FAILED_MARK=/var/tmp/devaim-deploy-failed
if [ "$(cat "$FAILED_MARK" 2>/dev/null)" = "$NEW" ]; then
    exit 0
fi

# Anything root created in the project (a manual `git pull`, `npm` or
# `artisan` as root) blocks the build later. Stop before touching the site.
NOT_OWNED="$(find .git node_modules public/build storage bootstrap/cache \
    ! -user "$OWNER" -print -quit 2>/dev/null || true)"
if [ -n "$NOT_OWNED" ]; then
    log "NOT deploying ${NEW:0:7}: $NOT_OWNED is not owned by $OWNER."
    log "Fix with: chown -R $OWNER:$OWNER $APP"
    echo "$NEW" > "$FAILED_MARK"
    exit 1
fi

log "deploying ${OLD:0:7} -> ${NEW:0:7}"
CHANGED="$(as_owner git diff --name-only "$OLD" "$NEW")"
changed() { grep -qE "$1" <<<"$CHANGED"; }

build() {
    if changed '^composer\.(json|lock)$'; then
        as_owner composer install --no-dev --optimize-autoloader --no-interaction --no-progress
    fi
    if changed '^package(-lock)?\.json$' || [ ! -d node_modules ]; then
        as_owner npm ci --no-audit --no-fund
    fi
    as_owner npm run build
    if changed '^database/migrations/'; then
        as_owner php artisan migrate --force
    fi
    as_owner php artisan optimize
    systemctl reload "$PHP_FPM"   # clears OPcache so PHP sees the new code
}

rollback() {
    log "FAILED on ${NEW:0:7}; rolling back to ${OLD:0:7} (not retried until the next push)"
    echo "$NEW" > "$FAILED_MARK"
    as_owner git reset --hard --quiet "$OLD"
    as_owner npm run build || true
    as_owner php artisan optimize || true
    systemctl reload "$PHP_FPM" || true
    exit 1
}

# --ff-only refuses to merge if someone edited files on the server; that
# stops the deploy (and shows in the log) instead of mixing changes.
as_owner git merge --ff-only --quiet "origin/$BRANCH"
trap rollback ERR
build
trap - ERR

log "live on ${NEW:0:7}: $(as_owner git log -1 --format=%s)"
