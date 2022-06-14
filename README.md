<h1 align="center">StandingTimes</h1>

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/Zenonik/StandingTimes/master/public/img/logo.svg" width="400"></a></p>

## About StandingTimes

StandingTimes is a simple, easy-to-use, and free to use application for keeping track of how long you've been standing at your desk.

## Installation

```bash
# It's copying the `.env.example` file to `.env` so that you can edit the environment variables.
$ cp .env.example .env
# It's installing all the dependencies that are listed in the `composer.json` file.
$ composer install
# It's generating a random key for the application.
$ php artisan key:generate
# It's creating the database tables.
$ php artisan migrate
# It's creating a symbolic link from `public/storage` to `storage/app/public`.
$ php artisan storage:link
```