<?php

namespace Zerp\Calendar\Providers;

use Illuminate\Support\ServiceProvider;

class CalendarServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $routesPath = __DIR__.'/../Routes/web.php';
        if (file_exists($routesPath)) {
            $this->loadRoutesFrom($routesPath);
        }

        $apiRoutesPath = __DIR__.'/../Routes/api.php';
        if (file_exists($apiRoutesPath)) {
            $this->loadRoutesFrom($apiRoutesPath);
        }

        // Scoped Swagger/OpenAPI docs for this module at /docs/calendar.
        if (class_exists(\Dedoc\Scramble\Scramble::class)) {
            \Dedoc\Scramble\Scramble::registerApi('calendar', [
                'api_path' => 'api/calendar',
                'info' => ['version' => \Composer\InstalledVersions::getPrettyVersion('zerp/calendar') ?? '1.0.0', 'description' => 'Zerp Calendar module REST API for mobile and third-party clients.'],
                'ui' => ['title' => 'Zerp Calendar API'],
            ])->expose(ui: '/docs/calendar', document: '/docs/calendar.json');
        }

        $migrationsPath = __DIR__.'/../Database/Migrations';
        if (is_dir($migrationsPath)) {
            $this->loadMigrationsFrom($migrationsPath);
        }
    }

    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
    }
}