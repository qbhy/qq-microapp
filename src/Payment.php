<?php


namespace Qbhy\QqMicroApp;

use GuzzleHttp\RequestOptions;
use Qbhy\QqMicroApp\Support\Str;
use Qbhy\QqMicroApp\Support\XML;
use function Qbhy\QqMicroApp\Support\generate_sign;
use function Qbhy\QqMicroApp\Support\get_client_ip;
use function Qbhy\QqMicroApp\Support\get_encrypt_method;

/**
 * Class Payment
 * @todo 未测试，商户申请还没通过
 * @package Qbhy\QqMicroApp
 */
class Payment
{
    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }

    /**
     * @param  string  $api
     * @param  array  $attributes
     * @return array
     */
    protected function request(string $api, array $attributes)
    {
        $nonceStr = Str::random(32);
        $params = array_merge([
            'appid' => $this->app->getAppId(),
            'mch_id' => $this->app->getMchId(),
            'nonce_str' => $nonceStr,
        ], $attributes);

        $params['sign'] = generate_sign($params, $this->app->getMchKey());

        return Xml::parse(
            $this->app->http->request('POST', $api, [
                RequestOptions::BODY => XML::build($params)
            ])->getBody()->__toString()
        );
    }

    /**
     * 统一下单
     * @param  array  $attributes
     * @return array
     * 统一下单接口
     * @link https://qpay.qq.com/buss/wiki/38/1203 完整参数文档
     */
    public function unified(array $attributes)
    {
        return $this->request('https://qpay.qq.com/cgi-bin/pay/qpay_unified_order.cgi', array_merge([
            'fee_type' => $attributes['fee_type'] ?? 'CNY',
            'spbill_create_ip' => $attributes['spbill_create_ip'] ?? get_client_ip(),
        ], $attributes));
    }

    /**
     * 检查异步通知的合法性
     * @param  array  $attributes
     * @return bool
     */
    public function notifyCheck(array $attributes): bool
    {
        if (empty($attributes['sign'])) {
            return false;
        }

        $sign = $attributes['sign'];
        unset($attributes['sign']);

        return generate_sign($attributes, $this->app->getMchKey()) === $sign;
    }

    /**
     * 查新订单
     * @link https://qpay.qq.com/buss/wiki/38/1205 完整参数文档
     * @param  array  $attributes
     * @return array
     */
    public function queryOrder(array $attributes)
    {
        return $this->request('https://qpay.qq.com/cgi-bin/pay/qpay_order_query.cgi', $attributes);
    }

    /**
     * 关闭订单
     * @link https://qpay.qq.com/buss/wiki/38/1206 完整参数文档
     * @param  array  $attributes
     * @return array
     */
    public function closeOrder(array $attributes)
    {
        return $this->request('https://qpay.qq.com/cgi-bin/pay/qpay_close_order.cgi', $attributes);
    }

    /**
     * 申请退款
     * @link https://qpay.qq.com/buss/wiki/38/1207 完整参数文档
     * @param  array  $attributes
     * @return array
     */
    public function refund(array $attributes)
    {
        return $this->request('https://api.qpay.qq.com/cgi-bin/pay/qpay_refund.cgi', $attributes);
    }

    /**
     * 查询退款
     * @link https://qpay.qq.com/buss/wiki/38/1208 完整参数文档
     * @param  array  $attributes
     * @return array
     */
    public function queryRefund(array $attributes)
    {
        return $this->request('https://qpay.qq.com/cgi-bin/pay/qpay_refund_query.cgi', $attributes);
    }

    /**
     * 交易账单
     * @link https://qpay.qq.com/buss/wiki/38/1209 完整参数文档
     * @param  array  $attributes
     * @return array
     */
    public function statementDownload(array $attributes)
    {
        return $this->request('https://qpay.qq.com/cgi-bin/sp_download/qpay_mch_statement_down.cgi', $attributes);
    }

    /**
     * 资金账单
     * @link https://qpay.qq.com/buss/wiki/38/3089 完整参数文档
     * @param  array  $attributes
     * @return array
     */
    public function accRoll(array $attributes)
    {
        return $this->request('https://qpay.qq.com/cgi-bin/sp_download/qpay_mch_acc_roll.cgi', $attributes);
    }

}