#!/usr/bin/env bash
set -e

# Run migrations automatically on startup
echo "[ENTRYPOINT] Running migrations..."
php artisan migrate --force

# Run RolePermissionSeeder
echo "[ENTRYPOINT] Running RolePermissionSeeder..."
php artisan db:seed --class=RolePermissionSeeder --force

# Run UserSeeder
echo "[ENTRYPOINT] Running UserSeeder..."
php artisan db:seed --class=UserSeeder --force

# Execute the main container command (FrankenPHP)
echo "[ENTRYPOINT] Starting FrankenPHP..."
exec frankenphp run --config /etc/caddy/Caddyfile
