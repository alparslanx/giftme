<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiGuestRoutes();


        $this->mapApiUserRoutes();


        $this->mapApiAdminRoutes();

        $this->mapWebUserRoutes();

        $this->mapWebGuestRoutes();


        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebUserRoutes()
    {
        Route::middleware(['web.user'])
            ->domain('giftme.com')
            ->namespace($this->namespace.'\Web\User')
            ->group(base_path('routes/Web/user.php'));
    }

    protected function mapWebGuestRoutes()
    {
        Route::middleware(['web.guest'])
            ->domain('giftme.com')
            ->namespace($this->namespace.'\Web\Guest')
            ->group(base_path('routes/Web/guest.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiGuestRoutes()
    {
        Route::domain('api.giftme.com')
            ->prefix('guest')
             ->middleware(['api.guest','api.accessOrigin'])
             ->namespace($this->namespace.'\Api\Guest')
             ->group(base_path('routes/Api/guest.php'));
    }

    protected function mapApiUserRoutes()
    {
        Route::domain('api.giftme.com')
            ->prefix('user')
            ->middleware(['api.user','api.accessOrigin'])
            ->namespace($this->namespace.'\Api\User')
            ->group(base_path('routes/Api/user.php'));
    }

    protected function mapApiAdminRoutes()
    {
        Route::domain('api.giftme.com')
            ->prefix('admin')
            ->middleware(['api.admin','api.accessOrigin'])
            ->namespace($this->namespace.'\Api\Admin')
            ->group(base_path('routes/Api/admin.php'));
    }
}
