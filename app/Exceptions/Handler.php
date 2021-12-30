<?php

namespace App\Exceptions;

use App\Traits\ApiResponser;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ApiResponser;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (ValidationException $e, $request) {
            return $this->convertValidationExceptionToResponse($e, $request);
        });
        $this->renderable(function (AuthenticationException $exception, $request) {
            return $this->unauthenticated($request, $exception);
        });

        $this->renderable(function (AuthorizationException $exception, $request) {
            return $this->errorResponse($exception->getMessage(), 403);
        });

        $this->renderable(function (NotFoundHttpException $exception, $request) {
            return $this->errorResponse(__("messages.notFound"), 404);
        });
        $this->renderable(function (MethodNotAllowedException $exception, $request) {
            return $this->errorResponse('the specified method for the request is invalid', 405);
        });
        $this->renderable(function (\HttpException $exception, $request) {
            return $this->errorResponse($exception->getMessage(), $exception->getStatusCode());
        });
        /*$this->renderable(function (\BadMethodCallException $exception, $request) {
            return $this->errorResponse("something went wrong!", 500);
        });*/
        $this->renderable(function (QueryException $exception, $request) {
        /*    if($exception->errorInfo[0] == '42S02')
                return  $this->errorResponse($exception->errorInfo[2],500);
            if ($exception->errorInfo[1] == 1451)
                return $this->errorResponse('cannot remove this resource permanently, it is related with another resource', 409);
*/
            return $this->errorResponse($exception->getMessage(), 500);
        });
        $this->renderable(function (ModelNotFoundException $exception, $request) {
            $modelName = strtolower(class_basename($exception->getModel()));
            return $this->errorResponse("doesnt exists any {$modelName} with the specified indictor!", 200);
        });


    }
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return $this->errorResponse("unauthenticated",401);
    }

    protected function convertValidationExceptionToResponse(ValidationException $e, $request)
    {
        $errors = $e->validator->errors()->first();
        return $this->errorResponse($errors, 422);
    }
}
