<?php

declare(strict_types=1);

namespace App\Controllers;

use GuzzleHttp\Psr7\Utils;
use GuzzleHttp\Psr7\Response;

class HomeController
{
    public function index(): Response
    {
        $stream = Utils::streamFor("Homepage");

        $response = new Response;

        $response = $response->withBody($stream);

        return $response;
    }
}