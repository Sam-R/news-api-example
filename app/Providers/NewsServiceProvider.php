<?php

namespace App\Providers;

use App\Http\Clients\NewsClient;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(NewsClient::class, function ($app) {
            return new NewsClient([
                'base_uri' => env('NEWS_API_URL'),
                'headers' => [
                    'authorization' => env('NEWS_API_TOKEN')
                ],
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
