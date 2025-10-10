<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Psr7\HttpFactory;
use Nyholm\Psr7\Factory\Psr17Factory;

class HomeController
{
    public function index(): ResponseInterface
    {
        // $factory = new HttpFactory;
        $factory = new Psr17Factory;

        $stream = $factory->createStream("Homepage");

        $response = $factory->createResponse(200);

        $response = $response->withBody($stream);

        return $response;
    }
}