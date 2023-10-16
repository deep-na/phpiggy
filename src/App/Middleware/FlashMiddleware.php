<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class FlashMiddleware implements MiddlewareInterface
{
    function __construct(private TemplateEngine $view)
    {
    }
    public function process(callable $next)
    {
        $this->view->addGlobalTemplateData('errors', $_SESSION['errors'] ?? []);
        $this->view->addGlobalTemplateData('oldFormData', $_SESSION['errors'] ?? []);
        $next();
    }
}
