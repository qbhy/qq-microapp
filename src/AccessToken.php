<?php


namespace Qbhy\QqMicroApp;


use Hanson\Foundation\AbstractAccessToken;

class AccessToken extends AbstractAccessToken
{
    protected $tokenJsonKey = 'access_token';

    protected $expiresJsonKey = 'expires_in';

    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }

    /**
     * 从服务端获取 access token
     * @return mixed|void
     * @throws \Hanson\Foundation\Exception\HttpException
     */
    public function getTokenFromServer()
    {
        return json_decode((string)$this->app->http->get('https://api.q.qq.com/api/getToken', [
            'appid' => $this->app->getAppId(),
            'secret' => $this->app->getAppSecret(),
            'grant_type' => 'client_credential',
        ])->getBody(), true);
    }

    /**
     * @param $result
     * @return mixed|void
     * @throws QqMicroAppException
     */
    public function checkTokenResponse($result)
    {
        if (isset($result['errcode']) && $result['errcode'] !== 0) {
            throw new QqMicroAppException("获取 access token 失败：{$result['errmsg']}");
        }
    }
}