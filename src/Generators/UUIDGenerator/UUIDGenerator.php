<?php

namespace kosuha606\Yii2BaseKit\Generators\UUIDGenerator;

/**
 * Class UUIDGenerator
 * @package kosuha606\Yii2BaseKit\Generators\UUIDGenerator
 */
class UUIDGenerator
{
    /**
     * @param int $lenght
     * @return bool|string
     * @throws \Exception
     */
    public static function v1($lenght = 12)
    {
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($lenght / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($lenght / 2));
        } else {

        }
        return substr(bin2hex($bytes), 0, $lenght);
    }
}