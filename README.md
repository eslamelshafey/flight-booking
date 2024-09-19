create a copy from .env.example file with your database and mail server credentials

run `php artisan migrate:fresh --seed`

default user for testing is `test@test.com` & password is `asdasdasd`

run `php artisan queue:work` for sending a booking confirmation emails