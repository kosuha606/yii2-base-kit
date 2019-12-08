<?php

namespace kosuha606\Yii2BaseKit\Events;

use yii\base\Event;
use yii\db\Query;

/**
 * Class QueryEvent
 * @package kosuha606\Yii2BaseKit\Events
 */
class QueryEvent extends Event
{
    /** @var Query */
    public $query;
}