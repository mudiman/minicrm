
## About MiniCRM

Mini version of CRM for managing Companies and its employee:

## Requirement

Below is the requirement software to run the system. There are multiple alternative ways to run this laravel  project using docker or snail mention in 
[Laravel doc](https://laravel.com/docs/9.x#laravel-and-docker)

- PHP 9.19
- composer 
- mysql 8
- node 16
- npm

## Getting started

Fork this repository, then clone your fork, and run this in your newly created directory:

```bash
composer install
```

Next you need to make a copy of the `.env.example` file and rename it to `.env` inside your project root. And update the configuration based on your environment

Once the databse is up and its configuration is updated in .env. Run the following command to run database migration:

```
php artisan migrate
```
To setup some seed data run the below command which will create admin user and one company. 
```
php artisan db:seed
Login is 
username: admin@admin.com
password: password
```

Run below command to install all frontend dependencies
```
npm install
```

Then start your development server:

```
php artisan serve
```
also to constantly watch on changes to frontend and bundling run npm watch service using command
```
npm run dev
```
## Testing

To run all test 
```
php artisan test
```

## Deployment
For production have a separate .env file which should be environment name set to production and debug mode set to false

To optimize application for production use need to run some extra commands share below. To get more details of these command please read  [Laravel Production Optimzation](https://laravel.com/docs/9.x/deployment#optimization)
Generate optimize version of package cache
```
composer install --optimize-autoloader --no-dev
```
Cache config
```
php artisan config:cache
```
Cache Route
```
php artisan config:route
```
Cache view
```
php artisan view:cache
```
All these needs to be done

### Manage services
For manage hosting services look into [Laravel Hosting Solutions](https://laravel.com/docs/9.x/deployment#deploying-with-forge-or-vapor)
