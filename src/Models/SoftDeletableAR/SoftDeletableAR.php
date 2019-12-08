<?php

namespace kosuha606\Yii2BaseKit\Models\SoftDeletableAR;

use yii2tech\ar\softdelete\SoftDeleteBehavior;

/**
 * Class SoftDeletableAR
 * @package app\ARs
 * @method softDelete
 */
abstract class SoftDeletableAR extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'softDeleteBehavior' => [
                'class' => SoftDeleteBehavior::class,
                'softDeleteAttributeValues' => [
                    'isDeleted' => true
                ],
            ],
        ];
    }

    public static function find()
    {
        return parent::find()->andWhere(['isDeleted' => null]);
    }

    public function getInfo()
    {
        $notNeededAttrs = [
            'isDeleted',
            'created_by',
            'updated_by',
            'created_on',
            'updated_on'
        ];
        $info = '';
        $attrs = $this->attributes;
        foreach ($attrs as $attribute => $value) {
            if (in_array($attribute, $notNeededAttrs)) {
                continue;
            }
            $info .= '<b>' . $this->getAttributeLabel($attribute) . '</b>: ' . $value . '; <br>';
        }

        return $info;
    }
}