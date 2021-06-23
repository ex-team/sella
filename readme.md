# Simple Laravel
## Instalations
- Using `yarn install` or `npm install` for installing package libarary
- Using `composer install` for installing composer
- Using `yarn dev` for generate assets styling on webpack mix
- Using `php artisan key:generate` for generate key encryption app

## Packagist Libraries
- Cartalyst/Sentinel (PHP 7.3+ Fully-featured Authentication & Authorization System) `https://cartalyst.com/manual/sentinel/5.x#installation`
- Maatwebsite/excel (Supercharged Excel exports and imports in Laravel) `https://docs.laravel-excel.com/3.1/getting-started/installation.html`
- Dompdf (A DOMPDF Wrapper for Laravel) `https://github.com/barryvdh/laravel-dompdf`
- Intervention Image (Image handling and manipulation library with support for Laravel integration) `http://image.intervention.io/getting_started/installation`

## Import/Export Excel
- php artisan make:import NameofImport --model=Models/... for import model
- php artisan make:export NameofExport --model=Models/... for export model

## Remove Cache Larevel
- php artisan route:cache
- php artisan cache:clear
- php artisan config:cache
- php artisan view:clear
- php artisan optimize
