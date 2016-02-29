<?php


namespace Amin101\Irticket;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class IrticketServiceProvider extends  ServiceProvider
{


    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    public function boot()
    {
        $this->loadViewsFrom(realpath(__DIR__.'/../views'), 'irticket');
        $this->setupRoutes($this->app->router);
        // this  for conig
        $this->publishes([
            __DIR__.'/config/irticket.php' => config_path('irticket.php'),
        ]);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'Amin101\Irticket\Http\Controllers'], function($router)
        {
            require __DIR__.'/Http/routes.php';
        });
    }

    public function register()
    {
        $this->registerIrticket();
        config([
            'config/irticket.php',
        ]);
    }

    private function registerIrticket()
    {
        $this->app->bind('irticket',function($app){
            return new Irticket($app);
        });
    }
}