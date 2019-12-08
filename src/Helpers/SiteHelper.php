<?php

namespace kosuha606\Yii2BaseKit\Helpers;

use Yii;

/**
 * Class SiteHelper
 * TODO to see if yii2 have the same funcionality
 * @package kosuha606\Yii2BaseKit\Helpers
 */
class SiteHelper
{
    /**
     * @return bool
     */
    public static function isHome()
    {
        $controller = Yii::$app->controller;
        $default_controller = Yii::$app->defaultRoute;
        return (($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction)) ? true : false;
    }
}