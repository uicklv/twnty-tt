 ## First you must have Docker Desktop installed [Docker Desktop](https://www.docker.com/products/docker-desktop/) 
 ## Run container build in the terminal at the project root
 `docker compose up -d`
 ## Go to the container terminal and run installing composer packages
 `composer install`
 ## Copy .env.example change it to .env and fill
 ## Run migrations
 `php artisan migrate`
 ## Fill the database with fake data
 `php artisan db:seed`
 ## Run tests for employee endpoints
 `php artisan test`
 ## Run scheduler
 `php artisan schedule:work`
 ## Run queues
 `php artisan queue:work`
 ## Create symbolik link
 `php artisan storage:link`
 ## If you get a permission error, run this in a container terminal
 `chown -R www-data:www-data /var/www/`
 
  **Everything should work now :smile:**
