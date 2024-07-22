@echo off

set "FLAG="
for %%i in (%*) do (
    if "%%i"=="-mds" (
        set "FLAG=-mds"
    )
)

echo php artisan serve
start "" cmd /c "php artisan serve"
echo npm install
start "" cmd /c "npm install"
echo npm run dev
start "" cmd /c "npm run dev"

if defined FLAG (
    echo Migrations and data seed
    echo php artisan migrate:refresh
    start "" cmd /c "php artisan migrate:refresh"
    echo Polecenie 2
    start "" cmd /c "php artisan db:seed"
)

echo browser on: [http://localhost:8000/]
start "" "http://localhost:8000/"
echo Done
pause
