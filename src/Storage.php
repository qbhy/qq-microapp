<?php

namespace Qbhy\QqMicroApp;

/**
 * Class Storage
 * @package Qbhy\QqMicroApp
 */
class Storage
{
    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }

    public function remove(string $openid, $key, string $signature, string $sigMethod)
    {
        return json_decode((string) $this->app->http->post('https://api.q.qq.com/api/openDataContext/remove_user_storage',
            [
                'access_token' => $this->app->access_token->getToken(),
                'openid' => $openid,
                'signature' => $signature,
                'sig_method' => $sigMethod,
                'key' => $key,
            ])->getBody(), true);
    }

    public function set(string $openid, array $list, string $signature, string $sigMethod)
    {
        return json_decode((string) $this->app->http->post('https://api.q.qq.com/api/openDataContext/set_user_storage',
            [
                'access_token' => $this->app->access_token->getToken(),
                'openid' => $openid,
                'signature' => $signature,
                'sig_method' => $sigMethod,
                'list' => $list,
            ])->getBody(), true);
    }

    public function interactive(string $openid, array $list, string $signature, string $sigMethod)
    {
        return json_decode((string) $this->app->http->post('https://api.q.qq.com/api/setuserinteractivedata',
            [
                'access_token' => $this->app->access_token->getToken(),
                'openid' => $openid,
                'signature' => $signature,
                'sig_method' => $sigMethod,
                'list' => $list,
            ])->getBody(), true);
    }

}