<?php

declare(strict_types=1);

namespace App\Middlewares;

use Framework\TemplateEngine;

use Framework\Contracts\MiddlewareInterface;

class TemplateDataMiddleware implements MiddlewareInterface
{

    public function __construct(private TemplateEngine $view)
    {
        // var_dump($this->view);
        // echo "<br/>";
    }

    public function process(callable $next)
    {
        $this->view->addGlobal('title', 'Expense Tracking aPP');

        $next();
    }
}
