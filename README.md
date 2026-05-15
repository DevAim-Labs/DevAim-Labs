# DevAim-Labs

Front page of the website.

Laravel application (PHP 8.3+, Inertia + Vue). See the [Laravel documentation](https://laravel.com/docs) for framework topics.

## Local development

```bash
composer install
cp .env.example .env
php artisan key:generate
npm install
npm run dev
```

In another terminal, run `php artisan serve` or use [Valet for Windows](https://github.com/cretueusebiu/valet-windows) with the repository root as the site path (`public/` is the web root).
