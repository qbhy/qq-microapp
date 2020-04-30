<?php

namespace Qbhy\QqMicroApp;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['access_token'] = function (QqMicroApp $microApp) {
            return (new AccessToken($microApp))->setCache($microApp->cache);
        };

        $pimple['http'] = function (QqMicroApp $microApp) {
            return new HttpClient($microApp);
        };

        $pimple['auth'] = function (QqMicroApp $microApp) {
            return new Auth($microApp);
        };

        $pimple['storage'] = function (QqMicroApp $microApp) {
            return new Storage($microApp);
        };

        $pimple['qr_code'] = function (QqMicroApp $microApp) {
            return new QrCode($microApp);
        };

        $pimple['temp_msg'] = function (QqMicroApp $microApp) {
            return new TempMsg($microApp);
        };

        $pimple['subscription_msg'] = function (QqMicroApp $microApp) {
            return new SubscriptionMsg($microApp);
        };

        $pimple['content_security'] = function (QqMicroApp $microApp) {
            return new ContentSecurity($microApp);
        };

        $pimple['decrypt'] = function (QqMicroApp $microApp) {
            return new Decrypt($microApp);
        };

        $pimple['payment'] = function (QqMicroApp $microApp) {
            return new Payment($microApp);
        };
    }
}