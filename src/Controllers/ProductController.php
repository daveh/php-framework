<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;

class ProductController
{
    public function __construct(private ResponseFactoryInterface $factory)
    {
    }

    public function index(): ResponseInterface
    {
        $stream = $this->factory->createStream("List of products");

        $response = $this->factory->createResponse();

        $response = $response->withBody($stream);

        return $response;
    }

    public function show(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $id = $args["id"];

        $stream = $this->factory->createStream("Single product with ID $id");

        $response = $this->factory->createResponse();

        $response = $response->withBody($stream);

        return $response;
    }
}