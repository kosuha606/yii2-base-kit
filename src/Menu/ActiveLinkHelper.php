<?php

namespace kosuha606\Yii2BaseKit\Menu;

/**
 * Class ActiveLinkHelper
 * @package kosuha606\Yii2BaseKit\Menu
 */
class ActiveLinkHelper
{
    /**
     * @param $link
     * @return bool
     */
    public static function isLinkActive($link)
    {
        return strpos(\Yii::$app->request->getUrl(), $link) !== false;
    }
}