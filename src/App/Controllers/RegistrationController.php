<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\{ValidatorService, UserService};
use Framework\TemplateEngine;

class RegistrationController
{
    public function __construct(
        private TemplateEngine $templateEngine,
        private ValidatorService $validatorService,
        private UserService $userService
    ) {
    }

    function registration()
    {
        echo $this->templateEngine->render('registration.php', ['title' => 'Register', 'errors' => $_SESSION['errors'] ?? [], 'oldFormData' => $_SESSION['oldFormData'] ?? []]);
        unset($_SESSION['errors']);
        unset($_SESSION['oldFormData']);
    }

    function register()
    {

        $this->validatorService->validate($_POST);

        $this->userService->isEmailTaken($_POST['email']);

        $this->userService->addUser($_POST);

        redirectTo('/');
    }

    function renderPage()
    {
        echo $this->templateEngine->render('/login.php', ['title' => "Login", 'errors' => $_SESSION['errors'] ?? [], 'oldFormData' => $_SESSION['oldFormData'] ?? []]);
        unset($_SESSION['errors']);
        unset($_SESSION['oldFormData']);
    }

    function login()
    {

        $this->validatorService->validate($_POST);
    }
}
