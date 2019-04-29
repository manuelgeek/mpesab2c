<?php
/**
 * Created by PhpStorm.
 * User: manuelgeek
 * Date: 4/29/19
 * Time: 6:22 PM
 */

namespace Manuelgeek\MpesaB2C;


use Illuminate\Support\ServiceProvider;

class MpesaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('Manuelgeek\MpesaB2C\B2C');
        $this->registerFacades();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/mpesa_b2c.php' => config_path('mpesa_b2c.php')
        ]);
    }

    /**
     *
     */
    private function registerFacades()
    {
        $this->app->bind('mpesa_b2c', function () {
            return $this->app->make(\Manuelgeek\MpesaB2C\Facades\B2C::class);
        });

    }
}
