<?php namespace Hernandev\Sandbox\Providers;

use Illuminate\Routing\Router;
use Illuminate\Routing\Stack\Builder as Stack;
use Illuminate\Foundation\Support\Providers\AppServiceProvider as ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
	 * All of the application's route middleware keys.
	 *
	 * @var array
	 */
    protected $middleware = [
        'auth' => 'Hernandev\Sandbox\Http\Middleware\AuthMiddleware',
        'auth.basic' => 'Hernandev\Sandbox\Http\Middleware\BasicAuthMiddleware',
        'csrf' => 'Hernandev\Sandbox\Http\Middleware\CsrfMiddleware',
        'guest' => 'Hernandev\Sandbox\Http\Middleware\GuestMiddleware',
        'locale' => 'Hernandev\Sandbox\Http\Middleware\LocaleMiddleware'
    ];

    /**
	 * The application's middleware stack.
	 *
	 * @var array
	 */
    protected $stack = [
        'Hernandev\Sandbox\Http\Middleware\MaintenanceMiddleware',
        'Illuminate\Cookie\Middleware\Guard',
        'Illuminate\Cookie\Middleware\Queue',
        'Illuminate\Session\Middleware\Reader',
        'Illuminate\Session\Middleware\Writer',
    ];

    /**
	 * Build the application stack based on the provider properties.
	 *
	 * @return void
	 */
    public function stack()
    {
        $this->app->stack(function (Stack $stack, Router $router) {
            return $stack
                ->middleware($this->stack)->then(function ($request) use ($router) {
                    return $router->dispatch($request);
                });
            });
    }

}
