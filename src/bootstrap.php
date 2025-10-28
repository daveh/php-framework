<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\ServerRequest;
use HttpSoft\Emitter\SapiEmitter;
use League\Route\Router;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseFactoryInterface;
use GuzzleHttp\Psr7\HttpFactory;
use League\Route\Strategy\ApplicationStrategy;
use Framework\Template\RendererInterface;
use Framework\Template\Renderer;
use Framework\Template\PlatesRenderer;

ini_set("display_errors", 1);

require dirname(__DIR__) . "/vendor/autoload.php";

$request = ServerRequest::fromGlobals();

$builder = new DI\ContainerBuilder;

$builder->addDefinitions([
    ResponseFactoryInterface::class => DI\create(HttpFactory::class),
    RendererInterface::class => DI\create(PlatesRenderer::class)
]);

$builder->useAttributes(true);

$container = $builder->build();

$router = new Router;

$strategy = new ApplicationStrategy;
$strategy->setContainer($container);
$router->setStrategy($strategy);

$router->get("/", [HomeController::class, "index"]);

$router->get("/products", [ProductController::class, "index"]);

$router->get("/product/{id:number}", [ProductController::class, "show"]);

$response = $router->dispatch($request);

$emitter = new SapiEmitter;

$emitter->emit($response);