<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\Exceptions\ValidationException;

class ValidationExceptionMiddleware implements MiddlewareInterface
{

    public function process(callable $next)
    {
        try {
            $next();
        } catch (ValidationException $e) {
            // debugVar($e->errors);
            $oldFormData = $_POST;

            $excluded = ['password, confirmPassword'];
            $finalData = array_diff_key($oldFormData, $excluded);
            $_SESSION['errors'] = $e->errors;
            $_SESSION['oldFormData'] = $finalData;
            $referer = $_SERVER['HTTP_REFERER'];

            redirectTo($referer);
        }
    }
}
