#!/bin/bash
set -e

echo "Deployment started ..."

# Pull the latest version of the app
git pull origin master

# Install composer dependencies
composer install --no-interaction --prefer-dist --optimize-autoloader

# Clear the old cache
php artisan clear-compiled

# Recreate cache
php artisan optimize

# Resolve NVM
export NVM_DIR=~/.nvm
source ~/.nvm/nvm.sh

# Install npm dependencies
yarn install

# Compile npm assets
yarn build

# Run database migrations
php artisan migrate --force

echo "Deployment finished!"
