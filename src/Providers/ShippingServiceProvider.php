<?php

namespace AbdullahKasim\LaravelShipping\Providers;

use AbdullahKasim\LaravelShipping\Constants\Constants;
use AbdullahKasim\LaravelShipping\Constants\Environment;
use AbdullahKasim\LaravelShipping\Shipping\Http\Controllers\Validations\Validations;
use Illuminate\Support\ServiceProvider;

class ShippingServiceProvider extends ServiceProvider
{
    protected $namespace = 'AbdullahKasim\LaravelShipping\Shipping\Http\Controllers';
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            Constants::PACKAGE_DIR.'/database/migrations' => base_path('database/migrations')
        ], 'migrations');
        $this->publishes([
            Constants::PACKAGE_DIR.'/database/seeds' => base_path('database/seeds')
        ], 'seeders');
        \Validator::extend('password', function ($attribute, $value, $parameters, $validator) {
            // if password doesn't have a special character or space, invalidate
            if (preg_match('/['.Validations::SPECIAL_CHARACTERS.']+/', $value) !== 1) {
                return false;
            }
            // if password doesn't have a number, invalidate
            if (preg_match('/[0-9]/', $value) !== 1) {
                return false;
            }
            // if password doesn't have a character, invalidate
            if (preg_match('/[a-zA-Z]/', $value) !== 1) {
                return false;
            }
            return true;
        });
        $this->mapTestRoutes();
//        if (env(Environment::TESTING, false) === true) {
//            $this->mapTestRoutes();
//        }
    }

    /**
     * @return void
     */
    protected function mapTestRoutes()
    {
        \Route::prefix('test')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(Constants::PACKAGE_DIR . '/routes/tests.php');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
