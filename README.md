# Open Institute Leave System
## Support Solutions



## Installation

1. Clone the repo and `cd` into it
1. `composer install`
1. Rename or copy `.env.example` file to `.env`
1. `php artisan key:generate`
1. Set your database and mail credentials in your `.env` file
1. `php artisan migrate`. This will migrate the database
1. `php artisan db:seed` will run seeders necessary
1. `npm install`
1. `npm run dev`
1. `php artisan storage:link`
1. `nohup php artisan queue:work --deamon -d`
1. `php artisan optimize`
1. `php artisan serve` or use Laravel Valet or Laravel Homestead
1. Visit `localhost:8000` in your browser
