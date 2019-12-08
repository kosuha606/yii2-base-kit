<?php

namespace kosuha606\Yii2BaseKit\Modificators\BaseModelServiceModificator;

use kosuha606\Yii2BaseKit\Services\Base\BaseModelService;
use yii\base\Behavior;

/**
 * TODO to create more event handlers and events
 *
 * @see BaseModelService
 */
class BaseModelServiceModificator extends Behavior
{
    public function events()
    {
        return [
            BaseModelService::EVENT_BEFORE_MODEL_SAVE => 'handleBeforeModelSave',
        ];
    }

    public function handleBeforeModelSave()
    {

    }
}