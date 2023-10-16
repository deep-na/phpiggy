<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config;
use App\Config\Paths;

class HomeController
{


    public function __construct(private TemplateEngine $templateEngine)
    {
        //$this->templateEngine = new TemplateEngine(Paths::$VIEW);
    }

    public function home()
    {
        echo $this->templateEngine->render("/index.php", ['title' => "Home Page"]);
    }
}
