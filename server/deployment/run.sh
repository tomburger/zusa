# inspired by blob post
# https://sampo.co.uk/blog/creating-a-decent-laravel-deploy-script

php artisan down

composer update --no-interaction --prefer-dist --optimize-autoloader --no-dev

php artisan migrate --force

php artisan cache:clear

php artisan auth:clear-resets

php artisan route:clear
php artisan route:cache

php artisan config:clear
php artisan config:cache

php artisan up
