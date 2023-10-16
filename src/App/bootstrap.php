<?php

declare(strict_types=1);

use App\Config\Paths;
use Framework\App;
use function App\Config\{appRoutes, registerMiddleware};
// use Dotenv\Dotenv;

// $dotenv = Dotenv::createImmutable();

require __DIR__ . "/../../vendor/autoload.php";
// require __DIR__ . "/functions.php";

$app = new App(Paths::$SOURCE . "app/containerDifinition.php");

appRoutes($app);
registerMiddleware($app);

// $app->get('//about/team//');



return $app;
