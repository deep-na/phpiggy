<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Config\Paths;

class AboutController
{


    function __construct(
        private TemplateEngine $templateEngine
    ) {

        //  $this->templateEngine = new TemplateEngine(Paths::$VIEW);
    }

    function about()
    {
        echo $this->templateEngine->render('about.php', ["title" => "About", 'danger' => "<script> alert('Today')</script>"]);
    }
}
