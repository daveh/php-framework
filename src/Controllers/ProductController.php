<?php

declare(strict_types=1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Framework\Template\RendererInterface;

class ProductController
{
    public function __construct(private ResponseFactoryInterface $factory,
                                private RendererInterface $renderer)
    {
    }

    public function index(): ResponseInterface
    {
        $contents = $this->renderer->render("product/index");

        $stream = $this->factory->createStream($contents);

        $response = $this->factory->createResponse();

        $response = $response->withBody($stream);

        return $response;
    }

    public function show(ServerRequestInterface $request, array $args): ResponseInterface
    {
        $contents = $this->renderer->render("product/show", [
            "id" => $args["id"]
        ]);

        $stream = $this->factory->createStream($contents);

        $response = $this->factory->createResponse();

        $response = $response->withBody($stream);

        return $response;
    }
}