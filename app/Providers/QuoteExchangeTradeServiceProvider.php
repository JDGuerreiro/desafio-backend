<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class QuoteExchangeTradeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\Contracts\QuoteExchangeTradeInterface', function($app) {
            return new \App\Services\QuoteExchangeTradeService($app->make('GuzzleHttp\Client'));
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
