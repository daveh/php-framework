<?php

declare(strict_types=1);

namespace Framework\Controller;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Framework\Template\RendererInterface;
use DI\Attribute\Inject;

abstract class AbstractController
{
    #[Inject]
    private ResponseFactoryInterface $factory;

    #[Inject]
    private RendererInterface $renderer;

    protected function render(string $template, array $data = []): ResponseInterface
    {
        $contents = $this->renderer->render($template, $data);

        $stream = $this->factory->createStream($contents);

        $response = $this->factory->createResponse();

        $response = $response->withBody($stream);

        return $response;
    }
}