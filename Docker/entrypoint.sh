#!/bin/sh

PORT=${PORT:-8000}

php artisan key:generate || echo “Key generate failed”

php artisan migrate || echo “Migration failed”

php artisan db:seed || echo “Seeding failed”

php artisan cache:clear

php artisan config:clear

php artisan route:clear

php artisan storage:link

npm install

npm run build

exec php artisan serve --port=${PORT} --host=0.0.0.0 --env=.env