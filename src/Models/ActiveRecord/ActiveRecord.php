<?php

namespace kosuha606\Yii2BaseKit\Models\ActiveRecord;

use Yii;
use yii\base\Event;
use yii\helpers\Json;
use yii\helpers\Html;

/**
 * Class ActiveRecord
 * @package kosuha606\Yii2BaseKit\Models\ActiveRecord
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    const EVENT_BEFORE_SAVE = 'eventBeforeSave';

    const EVENT_AFTER_SAVE = 'eventAfterSave';

    /**
     * @var bool
     */
    public $validateDelete = true;

    /**
     * @var array
     */
    protected $deleteRules = [];

    /**
     * @param $filter
     * @return \yii\db\ActiveQuery
     */
    public static function search($filter)
    {
        $query = static::find();
        $registeredFilters = static::getFilters();
        if ($filter) {
            foreach ($filter as $key => $item) {
                if (!empty($registeredFilters[$key]) && $item != '') {
                    $callBack = $registeredFilters[$key];
                    $query = $callBack($query, $item);
                }
            }
        }
        return $query;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function field($name)
    {
        return Json::decode($this->$name, true);
    }

    /**
     * @param $property
     * @param $array
     */
    public function saveJson($property, $array)
    {
        $this->$property = Json::encode($array, JSON_UNESCAPED_UNICODE);
    }

    /**
     * Проверка можно ли удалять эту модель
     *
     * @return bool
     */
    public function validateDelete()
    {
        return $this->validateDelete;
    }

    /**
     *
     */
    public function disableDelete()
    {
        $this->validateDelete = false;
    }

    /**
     * @return bool
     */
    public function beforeDelete()
    {
        return parent::beforeDelete() && $this->validateDelete();
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        $this->trigger(static::EVENT_AFTER_SAVE, new Event(['data' => $this]));
        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        $this->trigger(static::EVENT_BEFORE_SAVE, new Event(['data' => &$this]));

        return parent::beforeSave($insert);
    }

    /**
     * @return string
     */
    public static function name()
    {
        return 'Модель';
    }

    /**
     * @return string
     */
    public static function jsonName()
    {
        return Html::encode(json_encode([
            'class' => static::class
        ]));
    }

    /**
     * @return mixed|string
     */
    public function getMenuName()
    {
        return isset($this->name) ? $this->name : '';
    }

    /**
     *
     */
    public function getService()
    {

    }

    /**
     * @return array
     */
    protected static function filters()
    {
        return [];
    }

    /**
     * @return array
     */
    protected static function getFilters()
    {
        return array_merge([
            'id' => function($query, $value) {
                return $query->andWhere(['id' => $value]);
            }
        ], static::filters());
    }

    /**
     * @param $componentConfig
     */
    protected function registerComponent($componentConfig)
    {
        $compoentns = Yii::$app->getComponents();
        Yii::$app->setComponents(array_merge($compoentns, $componentConfig));
    }
}
