<?php

namespace Qbhy\QqMicroApp;

use Qbhy\QqMicroApp\Support\AES;
use Qbhy\QqMicroApp\Support\DecryptException;

/**
 *
 * Class Decrypt
 * @package Qbhy\QqMicroApp
 */
class Decrypt
{
    protected $app;

    public function __construct(QqMicroApp $microApp)
    {
        $this->app = $microApp;
    }

    /**
     * 解密敏感数据
     * @param string $encryptedData
     * @param string $sessionKey
     * @param string $iv
     * @return array
     * @throws DecryptException
     */
    public function decrypt(string $encryptedData, string $sessionKey, string $iv)
    {
        $decrypted = AES::decrypt(
            base64_decode($encryptedData, false), base64_decode($sessionKey, false), base64_decode($iv, false)
        );

        $decrypted = @json_decode($decrypted, true);

        if (!$decrypted) {
            throw new DecryptException('The given payload is invalid.');
        }

        return $decrypted;
    }
}