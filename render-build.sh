#!/usr/bin/env bash
# exit on error
set -o errexit

composer install --no-dev --optimize-autoloader

# Ejecutar migraciones y semillas automáticamente
php artisan migrate --force
php artisan db:seed --force
