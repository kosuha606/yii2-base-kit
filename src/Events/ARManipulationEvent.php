<?php

namespace kosuha606\Yii2BaseKit\Events;

use kosuha606\Yii2BaseKit\Models\ActiveRecord;
use yii\base\Event;

/**
 * Class ARManipulationEvent
 * @package kosuha606\Yii2BaseKit\Events
 */
class ARManipulationEvent extends Event
{
    /**
     * @var ActiveRecord
     */
    public $entity;

    /**
     * @var mixed
     */
    public $advanced;
}