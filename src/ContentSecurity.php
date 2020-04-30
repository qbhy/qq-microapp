<?php

namespace Qbhy\QqMicroApp;

use GuzzleHttp\RequestOptions;

/**
 * Class ContentSecurity
 * @package Qbhy\QqMicroApp
 * @link https://q.qq.com/wiki/develop/miniprogram/server/open_port/port_safe.html#security-mediacheckasync
 */
class ContentSecurity
{
    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }

    public function media($media)
    {
        return json_decode((string) $this->app->http->request('POST',
            'https://api.q.qq.com/api/json/security/ImgSecCheck', [
                RequestOptions::FORM_PARAMS => [
                    'access_token' => $this->app->access_token->getToken(),
                    'appid' => $this->app->getAppId(),
                    'media' => $media,
                ],
            ])->getBody(), true);
    }

    public function text($content)
    {
        return json_decode((string) $this->app->http->request('POST',
            'https://api.q.qq.com/api/json/security/MsgSecCheck', [
                RequestOptions::FORM_PARAMS => [
                    'access_token' => $this->app->access_token->getToken(),
                    'appid' => $this->app->getAppId(),
                    'content' => $content,
                ],
            ])->getBody(), true);
    }

    public function asyncMedia($media, $type)
    {
        return json_decode((string) $this->app->http->request('POST',
            'https://api.q.qq.com/api/json/security/MediaCheckAsync', [
                RequestOptions::FORM_PARAMS => [
                    'access_token' => $this->app->access_token->getToken(),
                    'appid' => $this->app->getAppId(),
                    'media_url' => $media,
                    'media_type' => $type,
                ],
            ])->getBody(), true);
    }

}