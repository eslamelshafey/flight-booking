create a copy from .env.example file with your database and mail server credentials

run `composer install`

run `npm install` then run `npm run build`

run `php artisan migrate:fresh --seed`

run `php artisan queue:work` for sending a booking confirmation emails

run `php artisan key:generate`

run `php artisan serve`

default user for testing is `test@test.com` & password is `asdasdasd`


