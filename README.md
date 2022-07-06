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

Add your credentials for connection to [ApiMedic](https://apimedic.com/).

```sh
APIMEDIC_USERNAME= "your_mail"
APIMEDIC_PASSWORD= "your_password"
```

## Project Setup
Inside the project folder run the following commands:

```sh
./vendor/bin/sail up
```
