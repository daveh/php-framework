<?php

declare(strict_types=1);

use GuzzleHttp\Psr7\ServerRequest;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use HttpSoft\Emitter\SapiEmitter;

ini_set("display_errors", 1);

require dirname(__DIR__) . "/vendor/autoload.php";

$request = ServerRequest::fromGlobals();

$page = $request->getQueryParams()["page"];

ob_start();

require dirname(__DIR__) . "/{$page}.php";

$content = ob_get_clean();

$stream = Utils::streamFor($content);

$response = new Response;

$response = $response->withStatus(418)
                     ->withHeader("X-Powered-By", "PHP")
                     ->withBody($stream);

$emitter = new SapiEmitter;

$emitter->emit($response);