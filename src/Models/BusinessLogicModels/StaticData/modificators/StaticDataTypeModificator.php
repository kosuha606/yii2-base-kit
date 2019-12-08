<?php

namespace kosuha606\Yii2BaseKit\Models\BusinessLogicModels\StaticData\modificators;

use kosuha606\Yii2BaseKit\Models\ActiveRecord\ActiveRecord;
use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\StaticData\StaticData;
use kosuha606\Yii2BaseKit\Modificators\BaseModelModificator\BaseModelModificator;
use yii\base\Event;

class StaticDataTypeModificator extends BaseModelModificator
{
    /** @var ActiveRecord */
    public $owner;

    public function handleAfterFind(Event $event)
    {
        foreach (StaticData::$types as $typeKey => $type) {
            $this->owner->contentArray[$typeKey] = $this->owner->content;
        }
    }

    public function handleBeforeSave(Event $event)
    {
        if (!$_POST && isset($_POST['StaticData']) && isset($_POST['StaticData']['contentArray'])) {
            return;
        }
        $contentArray = $_POST['StaticData']['contentArray'];
        foreach ($contentArray as $type => $value) {
            if ($value && $this->owner->type == $type) {
                $this->owner->content = $value;
                break;
            }
        }
    }
}