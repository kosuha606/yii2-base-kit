<?php

namespace kosuha606\Yii2BaseKit\Components\BaseComponent;

use kosuha606\Yii2BaseKit\Services\ArrayHelperService\ArrayHelperService;
use yii\base\Component;

/**
 * Class BaseComponent
 * @package kosuha606\Yii2BaseKit\Components\BaseComponent
 */
class BaseComponent extends Component
{
    /**
     * @return ArrayHelperService
     * @throws \yii\base\InvalidConfigException
     */
    public function getArrayHelperService()
    {
        return \Yii::$app->get('arrayHelperService');
    }
}