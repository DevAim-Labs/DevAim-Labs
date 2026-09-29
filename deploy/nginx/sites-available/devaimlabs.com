# Site config for devaimlabs.com on a DigitalOcean Droplet (nginx + PHP-FPM).
# Copy to /etc/nginx/sites-available/devaimlabs.com and symlink it into
# sites-enabled. Needs conf.d/devaimlabs-limits.conf and
# snippets/devaimlabs-headers.conf from this folder. See README.md.
#
# Adjust the three marked values: the project path, the PHP-FPM socket and,
# if you use www as the main host, the redirect direction.

# HTTP -> HTTPS (Let's Encrypt HTTP challenges keep working).
server {
    listen 80;
    listen [::]:80;
    server_name devaimlabs.com www.devaimlabs.com;

    location ^~ /.well-known/acme-challenge/ {
        root /var/www/devaimlabs/public;              # <- project path
    }
    location / {
        return 301 https://devaimlabs.com$request_uri;
    }
}

# www -> apex, so every page has one canonical host (matches APP_URL).
server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name www.devaimlabs.com;

    ssl_certificate     /etc/letsencrypt/live/devaimlabs.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/devaimlabs.com/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;

    return 301 https://devaimlabs.com$request_uri;
}

server {
    listen 443 ssl http2;
    listen [::]:443 ssl http2;
    server_name devaimlabs.com;

    root /var/www/devaimlabs/public;                  # <- project path
    index index.php;
    charset utf-8;

    ssl_certificate     /etc/letsencrypt/live/devaimlabs.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/devaimlabs.com/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;

    # Small forms only; slow-client (slowloris) protection.
    client_max_body_size 1m;
    client_body_timeout 10s;
    client_header_timeout 10s;
    send_timeout 10s;
    keepalive_timeout 15s;
    limit_conn devaim_conn 30;

    autoindex off;

    # Never serve dotfiles (.env, .git, ...); .well-known stays reachable.
    location ~ /\.(?!well-known/) {
        deny all;
        return 404;
    }

    # Laravel front controller. Everything that isn't a real file goes here.
    location / {
        include /etc/nginx/snippets/devaimlabs-headers.conf;
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Contact form: extra nginx limit on POSTs (Laravel limits per IP/email too).
    location = /contact {
        limit_req zone=devaim_contact burst=3 nodelay;
        try_files $uri /index.php?$query_string;
    }

    # PHP: only the front controller runs; every other .php path is a 404.
    location = /index.php {
        limit_req zone=devaim_php burst=40 nodelay;

        fastcgi_pass unix:/run/php/php8.3-fpm.sock;   # <- your PHP version
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
        fastcgi_read_timeout 30s;
    }
    location ~ \.php$ {
        return 404;
    }

    # Vite build output: hashed filenames, safe to cache forever.
    location ^~ /build/ {
        include /etc/nginx/snippets/devaimlabs-headers.conf;
        add_header Cache-Control "public, max-age=31536000, immutable" always;
        try_files $uri =404;
    }

    # Live demos, framed by the service pages in a sandboxed iframe. Static
    # pages with inline script/style, so they get their own CSP (no nonce).
    location ^~ /demo/ {
        include /etc/nginx/snippets/devaimlabs-headers.conf;
        add_header Content-Security-Policy "default-src 'self'; script-src 'self' 'unsafe-inline'; style-src 'self' 'unsafe-inline'; img-src 'self' data: blob:; font-src 'self' data:; connect-src 'self'; frame-ancestors 'self'; base-uri 'self'; form-action 'self'; object-src 'none'" always;
        add_header Cache-Control "public, max-age=3600" always;
        try_files $uri $uri/index.html =404;
    }

    # Demo fonts/assets: the sandboxed demo has an opaque ("null") origin, so
    # font loads are CORS requests. Fonts are public; "*" is safe.
    location ^~ /demo/assets/ {
        include /etc/nginx/snippets/devaimlabs-headers.conf;
        add_header Access-Control-Allow-Origin "*" always;
        add_header Cache-Control "public, max-age=2592000" always;
        try_files $uri =404;
    }

    # Other static files (logos, previews, og-image). Fixed filenames that can
    # change on deploy, so a week, not "immutable".
    location ~* \.(?:webp|avif|jpe?g|png|gif|svg|ico|woff2)$ {
        include /etc/nginx/snippets/devaimlabs-headers.conf;
        add_header Cache-Control "public, max-age=604800" always;
        try_files $uri =404;
        access_log off;
    }

    location = /favicon.ico { access_log off; log_not_found off; try_files $uri =404; }

    error_page 404 /index.php;
}
