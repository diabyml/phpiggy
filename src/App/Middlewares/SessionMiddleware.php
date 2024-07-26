<?php

declare(strict_types=1);

namespace App\Middlewares;

use App\Exceptions\SessionException;
use Framework\Contracts\MiddlewareInterface;

class SessionMiddleware implements MiddlewareInterface

{
    public function process(callable $next)
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            throw new SessionException("Session already active");
        }

        // ob_end_clean();
        // echo "hello";

        if (headers_sent($filename, $line)) {
            throw new SessionException("Headers already set. Consider enabling output buffering Data Outputted  from {$filename} - Line: {$line}");
        }

        session_start();

        $next();
        session_write_close();
    }
}
