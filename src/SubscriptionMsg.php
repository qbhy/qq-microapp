<?php

namespace Qbhy\QqMicroApp;

/**
 * Class TempMsg
 * @package Qbhy\QqMicroApp
 */
class SubscriptionMsg
{
    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }

    /**
     * 发送订阅消息
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
        return json_decode((string) $this->app->http->json('https://api.q.qq.com/api/json/subscribe/SendSubscriptionMessage', [
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