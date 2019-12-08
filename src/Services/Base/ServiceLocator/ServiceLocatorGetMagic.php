<?php

namespace kosuha606\Yii2BaseKit\Services\Base\ServiceLocator;

/**
 * Чтобы свойства сервис локатора не вызывались напрямую
 * нужно __get объявлять в отдельном классе
 *
 * @package kosuha606\Yii2BaseKit\Services\Base\ServiceLocator
 */
class ServiceLocatorGetMagic
{
    private function __construct()
    {
    }

    /** @var static */
    private static $instance;

    /**
     * Использовать нужно именно self
     * чтобы была возможность у потомков
     * делать публичные методы с сервисами
     *
     * @return static
     */
    public static function o()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * If client wants some service return
     * it by calling component name
     *
     * @param $name
     * @return null|object
     * @throws \yii\base\InvalidConfigException
     */
    public function __get($name)
    {
        return \Yii::$app->get($name);
    }
}