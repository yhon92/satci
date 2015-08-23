<?php namespace SATCI\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse',
		'Illuminate\Session\Middleware\StartSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		// 'SATCI\Http\Middleware\VerifyCsrfToken',
	];

	/**
	 * The application's route middleware.
	 *
	 * @var array
	 */
	protected $routeMiddleware = [
		'auth' 				=> 'SATCI\Http\Middleware\Authenticate',
		'auth.basic'  => 'Illuminate\Auth\Middleware\AuthenticateWithBasicAuth',
		'guest' 			=> 'SATCI\Http\Middleware\RedirectIfAuthenticated',
		'jwt.auth' 		=> 'Tymon\JWTAuth\Middleware\GetUserFromToken',
    'jwt.refresh' => 'Tymon\JWTAuth\Middleware\RefreshToken',
	];

}
