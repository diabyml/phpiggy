<?php

declare(strict_types=1);


require_once __DIR__ . "../../../vendor/autoload.php";

// use App\Config\Routes;

use App\Config\Paths;
use Framework\App;

use function App\Config\registerMiddleware;
use function App\Config\registerRoutes;

$app = new App(Paths::SOURCE . "App/container-definitions.php");

// Routes::register($app);
registerRoutes($app);
registerMiddleware($app);


// dd($app);


return $app;
