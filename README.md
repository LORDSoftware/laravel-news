Для запуска проекта необходимо переименовать .env.example в .env, указав в нем настройки БД и адрес проекта, а так же в командной строке выполнить команды:

composer install <br />
php artisan migrate <br />
php artisan db:seed <br />
php artisan key:generate

===========================================

Разработать небольшой новостной сайт-визитку.

На главной странице выводятся 3 новости (отображаем заголовок, краткий текст) отсортированных по дате добавления, с пагинатором и возможностью сортировки по дате в прямом и обратном порядке. Выводятся только активные новости.
В качестве меню реализовать список категорий, в которых есть новости. Вложенность категорий не ограничена.

Ссылка на страницу новости должна быть вида /news/news_title.
Страница /news/news_title должна отображать заголовок новости, текст новости, дату создания новости, а так же форму с комментариями под новостью

Страница /admin должна проверять авторизацию пользователя.

Администратор может:
1) Просматривать список новостей, добавлять\редактировать\удалять новость
2) Просматривать список категорий, добавлять\редактировать\удалять категорию

При добавлении категории нужно указать:
1) Название
2) Родительская категория

При добавлении новости нужно указать:
1) Заголовок
2) Категорию
3) анонс
4) подробный текст
