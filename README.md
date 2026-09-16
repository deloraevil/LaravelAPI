Документация: doc/Doc.docx

Запуск:

git clone https://github.com/deloraevil/LaravelAPI.git /ваше рабочее пространство/

cd /ваше рабочее пространство/

cp .env.example .env

docker compose run --rm laravel.test composer install

docker compose up -d –build

docker compose exec laravel.test php artisan key:generate

docker compose exec laravel.test php artisan migrate

docker compose exec laravel.test php artisan db:seed
