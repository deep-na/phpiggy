<?php

declare(strict_types=1);

function debugVar(mixed $value)
{
    echo "<pre>";
    print_r($value);
    echo "</pre>";
    die();
}

function e(mixed $data)
{
    return htmlspecialchars($data);
}

function redirectTo(string $path)
{
    header("Location: {$path}");
    // set the redirect code
    http_response_code(302);

    exit;
}
