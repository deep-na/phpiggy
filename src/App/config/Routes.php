<?php

declare(strict_types=1);

namespace App\Config;

use Framework\App;
use App\Controllers\{HomeController, AboutController, LoginController, RegistrationController};

function appRoutes(App $app)
{
    $app->get('/', [HomeController::class, 'home']);
    $app->get('/about', [AboutController::class, 'about']);
    $app->get('/register', [RegistrationController::class, 'registration']);
    $app->post('/register', [RegistrationController::class, 'register']);
    $app->get('/login', [RegistrationController::class, 'renderPage']);
    $app->post('/login', [RegistrationController::class, 'login']);
}
