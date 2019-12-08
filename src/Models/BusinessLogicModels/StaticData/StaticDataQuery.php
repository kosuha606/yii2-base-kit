<?php

namespace kosuha606\Yii2BaseKit\Models\BusinessLogicModels\StaticData;

use yii\db\ActiveQuery;

class StaticDataQuery extends ActiveQuery
{
    public function code($code)
    {
        return $this->andOnCondition(['slug' => $code])->limit(1);
    }
}