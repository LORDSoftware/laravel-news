Для запуска проекта необходимо переименовать .env.example в .env, указав в нем настройки БД и адрес проекта, а так же в командной строке выполнить команды:

composer install
php artisan migrate
php artisan db:seed
php artisan key:generate