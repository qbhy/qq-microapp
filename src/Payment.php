<?php


namespace Qbhy\QqMicroApp;

use function Qbhy\QqMicroApp\Support\get_client_ip;

/**
 * Class Payment
 * @package Qbhy\QqMicroApp
 * @todo 未完成
 */
class Payment
{
    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }


}