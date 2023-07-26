# How to make business application - step by step

## Create repository in git hosting (like GitHub)

## Clone repository

```
git clone https://github.com/tomburger/zusa.git
```

## Create development branch

```
git branch -b develop
```

## Start Laravel

```
mkdir server
composer create-project laravel/laravel server
cd server
```

Setup Apache server: https://www.itnetwork.cz/php/laravel/instalace-laravel-a-zprovozneni-projektu#_moznost-3-spusteni-pomoci-apache-serveru

## Setting up database

create file database/database.sqlite (can be empty)
change in file `.env` value for `DB_CONNECTION` to be `sqlite` and comment other lines below.

Run 
```
php artisan migrate
```

## Getting authentication ready

```
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate
npm install
npm run dev
```

