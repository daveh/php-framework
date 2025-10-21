<?php

declare(strict_types=1);

namespace Framework\Template;

interface RendererInterface
{
    public function render(string $template, array $data = []): string;
}