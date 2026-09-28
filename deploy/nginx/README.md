# nginx on the DigitalOcean Droplet

These are the configs for devaimlabs.com: nginx with PHP-FPM on a Droplet, and DNS at Namecheap. `public/.htaccess` is only used on Apache and does nothing here.

| File | Goes to | Context |
|---|---|---|
| `conf.d/devaimlabs-limits.conf` | `/etc/nginx/conf.d/` | `http {}`: rate-limit zones, `server_tokens off`, gzip types |
| `snippets/devaimlabs-headers.conf` | `/etc/nginx/snippets/` | security headers for static files |
| `sites-available/devaimlabs.com` | `/etc/nginx/sites-available/` | the site itself |

## Install

1. **DNS at Namecheap:** add an `A` record for `@` and one for `www`, both pointing to the Droplet IP.
2. **Certificate.** Run this once, before enabling the 443 blocks:
   ```bash
   sudo apt install certbot python3-certbot-nginx
   sudo certbot certonly --nginx -d devaimlabs.com -d www.devaimlabs.com
   ```
   Renewal runs automatically through the certbot timer. `options-ssl-nginx.conf` comes from certbot.
3. **Copy and enable:**
   ```bash
   sudo cp conf.d/devaimlabs-limits.conf /etc/nginx/conf.d/
   sudo cp snippets/devaimlabs-headers.conf /etc/nginx/snippets/
   sudo cp sites-available/devaimlabs.com /etc/nginx/sites-available/
   sudo ln -s /etc/nginx/sites-available/devaimlabs.com /etc/nginx/sites-enabled/
   sudo rm -f /etc/nginx/sites-enabled/default
   ```
4. **Check the marked values** in the site file:
   - the project path (`/var/www/devaimlabs/public`);
   - the PHP-FPM socket: `ls /run/php/` shows the version.
5. **Test, then reload:** `sudo nginx -t && sudo systemctl reload nginx`
   - On nginx 1.25.1 or newer, `nginx -t` warns that `listen ... http2` is deprecated. The warning is harmless. The old form is used on purpose because Ubuntu 24.04 ships nginx 1.24, which doesn't know `http2 on;`.
   - On 1.25.1+ you can drop `http2` from the `listen` lines and add `http2 on;` to both 443 blocks instead.

## Production `.env`

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://devaimlabs.com
LOG_LEVEL=info
SESSION_ENCRYPT=true
SESSION_SECURE_COOKIE=true
SESSION_LIFETIME=120
```

- **`TRUSTED_PROXIES`:** leave it empty. Visitors reach nginx directly, so Laravel sees their real IP. Only set it if you later put a DigitalOcean Load Balancer or Cloudflare in front; then set it to that proxy's IP range.
- **After every deploy:**
  ```bash
  php artisan config:cache && php artisan route:cache && php artisan view:cache
  ```

## Firewall

Use a DigitalOcean Cloud Firewall (or `ufw`) and allow inbound traffic only on:
- 80/tcp and 443/tcp from everyone;
- 22/tcp (SSH) from your own IP only, if possible.

Log in with SSH keys and turn off password login (`PasswordAuthentication no`).

## Check after going live

```bash
curl -sI https://devaimlabs.com | grep -iE 'strict|content-security|x-frame|permissions'
curl -sI https://devaimlabs.com/demo/assets/website/ | head -1          # expect 404, no directory listing
curl -sI https://devaimlabs.com/.env | head -1                          # expect 404
```

- **Demo fonts:** open a service page, start the live demo, and check in the DevTools Network tab that the `.woff2` files load with `Access-Control-Allow-Origin: *`.
- **Rate limiting:**
  ```bash
  for i in $(seq 1 60); do curl -s -o /dev/null -w "%{http_code}\n" https://devaimlabs.com/; done | sort | uniq -c
  ```
  You should see a few `429` responses.
