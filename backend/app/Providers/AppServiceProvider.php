<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CustomMarkdownService;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
{
    $this->app->singleton(CustomMarkdownService::class);
}

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if (request()->server('HTTP_X_FORWARDED_PROTO') == 'https') {
            URL::forceScheme('https');
        }

        // Or force it for production environment
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
