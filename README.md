# LightItBack

Back end LightIt challenge repo.

## Install Requeriments

- [Docker](https://www.docker.com/).

Project developed with [Laravel Sail](https://laravel.com/docs/9.x/sail/).

## Project Configuration
Copy the .env.example file.

```sh
cp .env.example .env
```

Add your credentials for connection to [ApiMedic](https://apimedic.com/) in the .env file.

```sh
APIMEDIC_USERNAME= "your_mail"
APIMEDIC_PASSWORD= "your_password"
```

## Project Setup
In the project folder level run the following commands:

```sh
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs
```

```sh
./vendor/bin/sail up -d
```

```sh
./vendor/bin/sail artisan migrate:fresh
```
