#!/bin/bash

# Copy .env.example to .env
echo "Copying .env.example to .env..."
cp .env.example .env

# Build container
echo "Building containers..."
sudo docker-compose build app


# Start MySQL container
docker-compose up -d mysql

# Wait for MySQL to start
echo "Waiting for MySQL to start..."
sleep 10

# Build and start Laravel container
echo "Starting Laravel container..."
docker-compose up -d app

# Install PHP dependencies
echo "Installing PHP dependencies..."
docker-compose run --rm composer install

# Generate Laravel application key
echo "Generating Laravel application key..."
docker-compose run --rm artisan key:generate

# Migrate the database
echo "Migrating the database..."
docker-compose run --rm artisan migrate

# Seed the database
echo "Seeding the database..."
docker-compose run --rm artisan db:seed

# cache the config
echo "Caching the config..."
docker-compose run --rm artisan config:cache

# cache the routes
echo "Caching the routes..."
docker-compose run --rm artisan route:cache

# cache the views
echo "Caching the views..."
docker-compose run --rm artisan view:cache

# cache events
echo "Caching events..."
docker-compose run --rm artisan event:cache
