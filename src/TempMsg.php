<?php

namespace Qbhy\QqMicroApp;

/**
 * Class TempMsg
 * @package Qbhy\QqMicroApp
 */
class TempMsg
{
    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }

    /**
     * 发送模版消息 (本接口在服务器端调用,目前只有今日头条支持，抖音和 lite 接入中, 2020-03-02)
     * @param  string  $to
     * @param  string  $tempId
     * @param  string  $formId
     * @param  array  $data
     * @param  string?  $page
     * @param  string? $emphasis
     * @return mixed
     */
    public function send(string $to, string $tempId, string $formId, array $data, $page = null, $emphasis = null)
    {
        return json_decode((string) $this->app->http->json('https://api.q.qq.com/api/json/template/send', [
            'appid' => $this->app->access_token->getToken(),
            'access_token' => $this->app->access_token->getToken(),
            'touser' => $to,
            'template_id' => $tempId,
            'page' => $page,
            'form_id' => $formId,
            'data' => $data,
            'emphasis_keyword' => $emphasis,
        ])->getBody(), true);
    }

}