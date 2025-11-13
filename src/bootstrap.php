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
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;

ini_set("display_errors", 1);

require dirname(__DIR__) . "/vendor/autoload.php";

$request = ServerRequest::fromGlobals();

$builder = new DI\ContainerBuilder;

$builder->addDefinitions([
    ResponseFactoryInterface::class => DI\create(HttpFactory::class),
    RendererInterface::class => DI\create(PlatesRenderer::class),
    EntityManagerInterface::class => function () {

        $paths = [dirname(__DIR__) . "/src/Entities"];

        $config = ORMSetup::createAttributeMetadataConfiguration($paths, true);

        $params = [
            "driver" => "pdo_mysql",
            "host" => "127.0.0.1",
            "dbname" => "shop_db",
            "user" => "USERNAME HERE",
            "password" => "PASSWORD HERE"
        ];

        $connection = DriverManager::getConnection($params, $config);

        return new EntityManager($connection, $config);
    }
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

$router->map(["GET", "POST"], "/product/new", [ProductController::class, "create"]);

$response = $router->dispatch($request);

$emitter = new SapiEmitter;

$emitter->emit($response);
