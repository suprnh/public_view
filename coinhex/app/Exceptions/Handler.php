<?php

namespace App\Exceptions;

//Use Exception;
Use Throwable;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Throwable $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    /*
    public function render($request, Exception $e)
    {
        return parent::render($request, $e);
    }
    */

    public function render($request, Throwable $e)
	{
        if($this->isHttpException($e)){
            switch ($e->getStatusCode()) {
                case '404':
                            \Log::error($e);
                        return \Response::view('404');
                break;

                case '500':
                    \Log::error($exception);
                        return \Response::view('500');   
                break;

                default:
                    return $this->renderHttpException($e);
                break;
            }
        }
        else
        {
            return parent::render($request, $e);
        }


        // return parent::render($request, $e);
    }
}
