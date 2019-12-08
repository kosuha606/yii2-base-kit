<?php

namespace kosuha606\Yii2BaseKit\Models;

use kosuha606\Yii2BaseKit\Models\ActiveRecord\ActiveRecord;
use yii\helpers\ArrayHelper;

class Combination extends ActiveRecord
{
    public static $baseEntity;

    public $wasPopulated = false;

    public $combinated = [];

    /**
     * @return array
     */
    public function getCombinated()
    {
        return $this->combinated;
    }

    /**
     * @param array $combinated
     */
    public function setCombinated(array $combinated)
    {
        $this->combinated = $combinated;
    }

    /**
     * @return string
     */
    public static function tableName()
    {
        /** @var ActiveRecord $baseModel */
        $baseModel = static::$baseEntity;

        return $baseModel::tableName();
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        /** @var ActiveRecord $baseModel */
        $baseModel = static::$baseEntity;
        $model = \Yii::createObject($baseModel);

        return $model->rules();
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        /** @var ActiveRecord $baseModel */
        $baseModel = static::$baseEntity;
        $model = \Yii::createObject($baseModel);

        return $model->attributeLabels();
    }

    /**
     * @param array $fields
     * @param array $expand
     * @param bool $recursive
     * @return array
     */
    public function toArray(array $fields = [], array $expand = [], $recursive = true)
    {
        $properties = $this->getCombinated();
        $attributes = $this->getAttributes();

        return ArrayHelper::merge($attributes, $properties);
    }

    /**
     *
     */
    public function afterPopulate()
    {
    }

    /**
     * @param $record
     * @param $row
     */
    public static function populateRecord($record, $row)
    {
        parent::populateRecord($record, $row);
        if (!$record->wasPopulated) {
            $record->wasPopulated = true;
            $record->afterPopulate();
        }
    }

    /**
     * @param $data
     * @param $relatedModelClass
     * @param BaseModelService $relatedService
     */
    public function proccessOneToMany(
        $data,
        $relateField,
        $relatedFieldValue,
        $relatedModelClass,
        $relatedService
    ) {
        /** @var ActiveRecord[] $all */
        $all = $relatedService->getAllCondition([$relateField=>$relatedFieldValue]);
        $allIds = array_column($all, 'id');

        foreach ($data as $datum) {
            /** @var ActiveRecord $model */
            $model = new $relatedModelClass($datum);
            if ($datum['id']) {
                $model = $relatedService->findOne($datum['id']);
                unset($datum['id']);
                $model->updateAttributes($datum);
            }
            if ($result = $model->save()) {
                $allIds = array_filter($allIds, function ($item) use ($model) {
                    return $item != $model->id;
                });
            }
        }

        $relatedService->deleteAll(['id' => $allIds]);
    }

    /**
     * @param array $row
     * @return ActiveRecord|Combination|object
     * @throws \yii\base\InvalidConfigException
     */
    public static function instantiate($row)
    {
        return \Yii::createObject(static::class);
    }
}