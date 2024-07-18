@echo off
echo php artisan serve
start "" cmd /c "php artisan serve"
echo npm install
start "" cmd /c "npm install"
echo npm run dev
start "" cmd /c "npm run dev"

echo Migrations and data seed
echo php artisan migrate:refresh
rem php artisan migrate:refresh
echo Polecenie 2
rem php artisan db:seed

echo browser on: [http://localhost:8000/]
start "" "http://localhost:8000/"
echo Done
pause
