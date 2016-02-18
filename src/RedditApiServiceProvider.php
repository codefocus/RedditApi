<?php

namespace Codefocus\RedditApi;

use Illuminate\Support\ServiceProvider;
use RedditApi;


class RedditApiServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/publish/config/redditapi.php' => config_path('redditapi.php'),
        ]);
        /*
        $this->mergeConfigFrom(
            __DIR__.'/publish/config/redditapi.php', 'redditapi'
        );
        */
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RedditApi::class, function($app) {
            return new RedditApi(config('redditapi'));
        });
    }
}
