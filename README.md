
# Dinner registration app for Amsterdam Windsurfing

### Made with [Laravel](https://laravel.com/)

----------

## Installation

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve


## Installation using Laravel Sail

For local development you can use [Laravel Sail](https://laravel.com/docs/9.x/sail). Useful commands are:

Startup sail


    ./vendor/bin/sail up

Make sure to also run the Yarn dev server together

    ./vendor/bin/sail yarn run dev

- The app will be available at http://localhost/
- The admin interface at http://localhost/admin/login
- Mailhog can be accessed at http://0.0.0.0:8025/#

## Artisan Tinker

Create new user with artisan tinker:

    ./vendor/bin/sail artisan tinker
    \App\Models\User::create(['name' => 'User', 'email' => 'user@example.com', 'password' => bcrypt('password')])


## Debugging using Buggregator

You can easily debug Laravel with [Buggregator](https://github.com/buggregator/app). This app is configured using the ray.php file.

Simply run the following docker command:

    docker run --pull always -p 23517:8000  -p 9912:9912 -p 9913:9913 butschster/buggregator:latest

And access the debugger at http://0.0.0.0:23517/
