#!/bin/bash

# Build container
echo "Building containers..."
sudo docker-compose build

# Copy .env.example to .env
echo "Copying .env.example to .env..."

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
