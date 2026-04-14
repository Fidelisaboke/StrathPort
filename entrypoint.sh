#!/usr/bin/env bash
set -e

# Run migrations automatically on startup
echo "[ENTRYPOINT] Running migrations..."
php artisan migrate --force

# Execute the main container command (FrankenPHP)
echo "[ENTRYPOINT] Starting FrankenPHP..."
exec frankenphp run --config /etc/caddy/Caddyfile
