<?php

namespace App\Services;

class RouteService
{
    private string $basePath;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function importRoutes(string $filePath): void
    {
        require_once $this->basePath . DIRECTORY_SEPARATOR . $filePath . ".php";
    }

}
