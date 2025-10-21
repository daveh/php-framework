<?php

declare(strict_types=1);

namespace Framework\Template;

use League\Plates\Engine;

class PlatesRenderer implements RendererInterface
{
    public function render(string $template, array $data = []): string
    {
        $engine = new Engine(dirname(__DIR__, 3) . "/views");

        return $engine->render($template, $data);
    }
}