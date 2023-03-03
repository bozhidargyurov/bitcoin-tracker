## Bitcoin tracker - how to set up

1. Git clone the project locally
2. Execute `composer install` to install the vendor packages
3. Execute `docker compose up` to start the containers
4. Log in to the app container (`bitcoin-tracker-laravel.test-1`) via `docker exec -it bitcoin-tracker-laravel.test-1 /bin/bash` and follow the steps below:
   1. Copy `.env.example` as `.env`
   2. Generate app key with `php artisan key:generate`
   3. Run `php artisan migrate` - to create the database structure
   4. Run `npm install && npm run dev` - to install the front-end dependencies and build the FE
   5. Run `php artisan schedule:work` - to start gathering data from the Bitfinex API
5. Open the website here: http://localhost/
6. Once there is enough data gathered from Bitfinex, you'll start seeing the chart populated.
7. Subscribe for a specific threshold through the form.
8. The received emails can be seen at http://localhost:8025/ (Mailpit)
9. To execute tests, run `php artisan test` within the container
