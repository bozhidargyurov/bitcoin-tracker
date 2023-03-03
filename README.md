## Bitcoin tracker - how to set up

1. Git clone the project locally
2. Execute `composer install` to install the vendor packages
3. Execute `docker compose up` to start the containers
4. Log in to the app container (`bitcoin-tracker-laravel.test-1`) via `docker exec -it bitcoin-tracker-laravel.test-1 /bin/bash` and execute the following commands:
   1. `php artisan migrate` - to create the database structure
   2. `npm install && npm run dev` - to install the front-end dependencies and build the FE
   3. `php artisan schedule:work` - to start gathering data from the Bitfinex API
5. Open the website here: http://localhost/
6. Once there is enough data gathered, you'll start seeing the chart populated.
7. Subscribe for a specific threshold through the form.
8. The received emails can be seen at http://localhost:8025/ (Mailpit)
9. To execute tests, run `php artisan test` within the container
