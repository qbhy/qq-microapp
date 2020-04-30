<?php

namespace Qbhy\QqMicroApp;

/**
 *
 * Class QrCode
 * @package Qbhy\TtMicroApp
 */
class QrCode
{
    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }

    /**
     * 获取小程序码
     * @param $path
     * @return mixed
     */
    public function create($path)
    {
        $result = $this->app->http->json('https://api.q.qq.com/api/json/qqa/CreateMiniCode', [
            'access_token' => $this->app->access_token->getToken(),
            'appid' => $this->app->getAppId(),
            'path' => $path,
        ])->getBody();

        return @json_decode($result, true) ?: $result;
    }

}