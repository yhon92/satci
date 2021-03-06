<?php 
namespace SATCI\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

  /**
   * A list of the exception types that should not be reported.
   *
   * @var array
   */
  protected $dontReport = [
    // \Symfony\Component\HttpKernel\Exception\HttpException::class,
    HttpException::class,
  ];

  /**
   * Report or log an exception.
   *
   * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
   *
   * @param  \Exception  $e
   * @return void
   */
  public function report(Exception $e)
  {
    return parent::report($e);
  }

  /**
   * Render an exception into an HTTP response.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Exception  $e
   * @return \Illuminate\Http\Response
   */
  public function render($request, Exception $e)
  {
    if ($e instanceof NotFoundHttpException) {
      return response()->view('layout')->header('Content-Type', 'text/html');
    }

    if ($e instanceof Johnnymn\Sim\Roles\Exceptions\RoleDeniedException) {
      // you can for example flash message, redirect...
      return redirect()->back();
    }

    return parent::render($request, $e);
  }
  
}
