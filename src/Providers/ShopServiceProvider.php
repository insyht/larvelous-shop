<?php

namespace Insyht\LarvelousShop\Providers;

use Illuminate\Support\ServiceProvider;
use Insyht\LarvelousShop\Console\InstallPlugin;

class ShopServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->publishes(
            [
                __DIR__ . '/../../public/vendor/insyht/larvelous-shop' => public_path('vendor/insyht/larvelous-shop'),
                __DIR__ . '/../../resources/js' => public_path('vendor/insyht/larvelous-shop/js')
            ],
            'insyht-larvelous-shop'
        );
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'insyht-larvelous-shop');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'insyht-larvelous-shop');

        if ($this->app->runningInConsole()) {
            $this->commands(
                [
                    InstallPlugin::class,
                ]
            );
        }
    }
}
