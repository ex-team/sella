# Simple Laravel

## Packagist Libraries
- Maatwebsite/excel (Supercharged Excel exports and imports in Laravel) `https://docs.laravel-excel.com/3.1/getting-started/installation.html`
- Dompdf (A DOMPDF Wrapper for Laravel) `https://github.com/barryvdh/laravel-dompdf`
- Intervention Image (Image handling and manipulation library with support for Laravel integration) `http://image.intervention.io/getting_started/installation`


## Instalations
- yarn install or npm install for installing package libarary
- composer install for installing composer
- yarn dev for run development mode
- php artisan key:generate for generate key encryption

## Import/Export Excel
- php artisan make:import NameofImport --model=Models/... for import model
- php artisan make:export NameofExport --model=Models/... for export model
- php artisan make:job ImportofJob for queue importing
- php artisan queue:work execute job

## Remove Cache Larevel
- php artisan route:cache
- php artisan cache:clear
- php artisan config:cache
- php artisan view:clear
- php artisan optimize
