<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class HomeController
{
    public function __construct(private ResponseFactoryInterface $factory)
    {
    }

    public function index(): ResponseInterface
    {
        $stream = $this->factory->createStream("Homepage");

        $response = $this->factory->createResponse(200);

        $response = $response->withBody($stream);

        return $response;
    }
}