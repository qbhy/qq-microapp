<?php

namespace Qbhy\QqMicroApp;

use Hanson\Foundation\Http;

class HttpClient extends Http
{
    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }
}