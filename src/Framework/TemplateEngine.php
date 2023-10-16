<?php

declare(strict_types=1);

namespace Framework;

class TemplateEngine
{
    private array $globalTemplateData = [];

    function __construct(private string $basePath)
    {
    }

    function render(string $template, array $data)
    {
        extract($data);
        extract($this->globalTemplateData);

        ob_start();

        include $this->resolve($template);

        $output = ob_get_contents();

        ob_end_clean();

        return $output;
    }

    function resolve(string $path): string
    {
        return  "{$this->basePath}/$path";
    }

    function addGlobalTemplateData(string $key, mixed $value)
    {

        $globalTemplateData[$key] = $value;
    }
}
