Документация doc/Doc.docx



cp .env.example .env

docker compose up -d --build

docker compose exec laravel.test composer install

docker compose exec laravel.test php artisan key:generate

docker compose exec laravel.test php artisan migrate

docker compose exec laravel.test php artisan db:seed
