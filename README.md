# Laravel Project

This is a Laravel project that uses Docker for development and deployment.

## Prerequisites

Before getting started, ensure that you have the following dependencies installed on your system:

- Docker: [Install Docker](https://docs.docker.com/get-docker/)
- Docker Compose: [Install Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

Follow these steps to set up and run the Laravel project:

1. Clone the repository:

   ```bash
   https://github.com/hellomohsinhello/ingredient_planner.git
   ```
   
2. Navigate to the project directory:

   ```bash
   cd ingredient_planner
   ```
   
3. Copy the contents of the `.env.example` file into a new file named `.env`:

   ```bash
    cp .env.example .env
    ```

4. Update the environment variables in the .env file as needed.
5. Build the Docker images:

   ```bash
   docker-compose build
   ```
   
6. Run the Docker app container:

   ```bash
    docker compose up -d app
    ```
   
7. Install composer dependencies:
8. 
   ```bash
   docker-compose run --rm composer install
   ```
   
9. Generate an application key:

   ```bash
    docker-compose run --rm artisan key:generate
    ```
   
10. Run database migrations:

    ```bash
    docker-compose run --rm artisan migrate
    ```
    
11. Seed the database (optional):

    ```bash
    docker-compose run --rm artisan db:seed
    ```
    
12. Cache the configuration (optional):

    ```bash
    docker-compose run --rm artisan config:cache
    ```
    
13. Cache the routes (optional):

    ```bash
    docker-compose run --rm artisan route:cache
    ```
    
14. Cache the routes (optional):

    ```bash
    docker-compose run --rm artisan route:cache
    ```
    
15. Access the application in a browser at `http://localhost:8000`.
