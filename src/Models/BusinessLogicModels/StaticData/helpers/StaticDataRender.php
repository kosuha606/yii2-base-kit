<?php

namespace kosuha606\Yii2BaseKit\Models\BusinessLogicModels\StaticData\helpers;

use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\StaticData\StaticData;

class StaticDataRender
{
    public static function byCode($code)
    {
        return StaticData::find()->code($code)->one()->content;
    }
}