<?php

declare(strict_types=1);


function dd(mixed $var): void
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}

function e(mixed $value): string
{
    return htmlspecialchars((string)$value);
}

function redirectTo(string $path): void
{
    header("Location: {$path}");
    http_response_code(302);
    exit();
}
