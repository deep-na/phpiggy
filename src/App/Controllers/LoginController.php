<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\UserService;
use App\Services\ValidatorService;
use Framework\TemplateEngine;

class LoginController
{
    public function __construct(
        private TemplateEngine $templateEngine,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {
    }

    function renderPage()
    {
        echo $this->templateEngine->render('/login.php', ['title' => "Login", 'loginErrors' => $_SESSION['loginErrors'] ?? []]);
    }

    function login()
    {

        $this->validatorService->validate($_POST);
    }
}
