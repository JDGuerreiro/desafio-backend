<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class GuzzleClientServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('GuzzleHttp\Client', function($app) {
            return new \GuzzleHttp\Client([
                'base_uri' => $app->make('config')->get('app.quote_exchange_trade_api'),
                'verify' => false
            ]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
