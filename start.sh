#!/bin/bash

# Install dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Clear config & generate app key
php artisan config:clear
php artisan key:generate

# Run migrations (لو أول مرة)
php artisan migrate --force

# Link storage
php artisan storage:link

# Start Laravel on port 8080 (زي ما Railway متوقع)
php artisan serve --host=0.0.0.0 --port=8080
