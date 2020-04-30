<?php

namespace Qbhy\QqMicroApp;

/**
 * Class Auth
 * @package Qbhy\QqMicroApp
 */
class Auth
{
    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }

    /**
     * @param  string  $code
     * @return array
     * @throws
     */
    public function session(string $code)
    {
        return json_decode((string) $this->app->http->get('https://api.q.qq.com/sns/jscode2session', [
            'appid' => $this->app->getAppId(),
            'secret' => $this->app->getAppSecret(),
            'grant_type' => 'authorization_code',
            'js_code' => $code,
        ])->getBody(), true);
    }

}