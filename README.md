## Dashboard application based on PHP Laravel and VueJS

***

## Required dependencies


- Apache server >= 2.4.41
- MySql server >= 8.0.26
- Git
- PhP >= 7.4.3
- Composer >= v2.0.8
- NPM >= 7.11.2

***

## Quick start

0. Make sure you have both apache and mysql server up and configured for the app directory
1. Clone git repository from git@github.com:TimSavinov/dashboard-app.git
2. Create DB based on the dump file [moodle.sql]
3. Create .env file  using `cp .env.example .env` 
4. Add DB information to .env (DB name, user, password e.t.c.)
5. Install dependencies by running `composer install`
6. Generate application key by `php artisan key:generate`
7. Migrate 'monitors settings' table using `php artisan migrate`
8. Run `npm install` and `npm run dev` to get application up and running

