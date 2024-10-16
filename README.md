# bookside-backend-app

## Start

### Prerequirements

1. A docker for or a mariaDB database for a database.
2. A Composer with PHP.

## Steps

1. `composer install`
2. Start a database.
    1. Execute `docker-compose up -d` a the project folder if using docker.
3. `php artisan migrate`

