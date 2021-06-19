<?php

namespace jainsubh\GoogleSearchApi;

use Illuminate\Support\ServiceProvider;

class GoogleSearchApiProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/googlesearchapi.php' => config_path('googlesearchapi.php'),
        ]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('googlesearchapi', function () {
            return new GoogleSearchApi(config('googlesearchapi.google_search_engine_id'), config('googlesearchapi.google_search_api_key'));
        });
    }
}
