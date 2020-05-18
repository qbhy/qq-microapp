## qq-microapp
QQ小程序 sdk  
QQ小程序服务端API官方文档 [点击前往](https://q.qq.com/wiki/develop/miniprogram/server/)

* API 齐全
* 丰富合理的注释
* 完善的参数提示
* 支持 `composer` 安装
* 支持 laravel/lumen 框架

## 相关资源
* 字节跳动小程序php-sdk https://github.com/qbhy/tt-microapp

## 安装 - install
```bash
$ composer require 96qbhy/qq-microapp 
```

## 使用 - usage
```php
require 'vendor/autoload.php';

$redisCache = new \Doctrine\Common\Cache\RedisCache();// 更多缓存驱动请移步 https://www.doctrine-project.org/projects/doctrine-orm/en/current/reference/caching.html
//$redisCache->setRedis($redis); // 设置你的 redis 实例，可选


$app = new \Qbhy\QqMicroApp\QqMicroApp([
    'access_key' => 'your app id',
    'secret_key' => 'your app secret',
    'debug' => true,
    'cache' => $redisCache, // 可选参数，你也可以用 \Doctrine\Common\Cache\ 下面得其他缓存驱动，比如 sqlite 等
]);

var_dump($app->access_token->getToken()); // 获取 access token
var_dump($app->auth->session('client code')); // 获取 登录
var_dump($app->temp_msg->send('openid', 'template id', 'form id', [], 'page')); //模板消息
var_dump($app->subscription_msg->send('openid', 'template id', 'form id', [], 'page')); //订阅消息
var_dump($app->storage); // 存储接口
var_dump($app->qr_code->create('/pages/index')); // 创建二维码接口
var_dump($app->content_security); // 内容安全接口、图片和文本检测
var_dump($app->decrypt->decrypt('encrypted data', 'session key', 'iv')); // 敏感数据处理
var_dump($app->payment); // 开发完未测试，本人商户号还未通过审核
```

php吹水交流群请添加: 873213948  
https://github.com/qbhy/qq-microapp  
96qbhy@gmail.com