Для запуска проекта необходимо переименовать .env.example в .env, указав в нем настройки БД и адрес проекта, а так же в командной строке выполнить команды:

composer install <br />
php artisan migrate <br />
php artisan db:seed <br />
php artisan key:generate