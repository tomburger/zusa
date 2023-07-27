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

We need to use breeze 1.9.4, because we are using Laravel 8.
For Laravel 9, it will be possible to use breeze 1.10 with Vite support

```
composer require laravel/breeze --dev
php artisan breeze:install blade
php artisan migrate
npm install
npm run dev
```

## Adding Svelte (initial attempt)

```
npm create vite@latest client -- --template svelte-ts
cd client
npm install
```

