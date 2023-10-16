<?php

declare(strict_types=1);

use App\Config\Paths;
use App\Services\{ValidatorService, UserService};
use Framework\Container;
use Framework\Database;
use Framework\TemplateEngine;

return [
    TemplateEngine::class => fn () => new TemplateEngine(Paths::$VIEW),
    ValidatorService::class => fn () => new ValidatorService(),
    Database::class => fn () => new Database('mysql', [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'phpiggy'
    ], 'root', ''),
    UserService::class => function (Container $container) {
        $db = $container->get(Database::class);

        return new UserService($db);
    }
];
