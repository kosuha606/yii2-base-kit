<?php

namespace kosuha606\Yii2BaseKit\Services\ArHelperService;

use yii\db\Query;

class ArHelperService
{
    public function findAll(
        $activeRecord,
        $condition = [],
        $relations = [],
        $constraints = ['order' => 'id ASC', 'limit' => null],
        $asArray = true
    ) {
        /** @var Query $query */
        $query = $activeRecord::find()->where($condition)->with($relations);
        if (isset($constraints['order']) && $constraints['order'] !== 'id ASC') {
            $query->orderBy($constraints['order']);
        }
        if (isset($constraints['limit']) && $constraints['limit']) {
            $query->limit($constraints['limit']);
        }
        if ($asArray) {
            $query->asArray();
        }

        return $query->all();
    }

    public function findOne(
        $activeRecord,
        $condition = [],
        $relations = [],
        $asArray = true
    ) {
        if ($asArray) {
            return $activeRecord::find()->where($condition)->with($relations)->asArray()->limit(1)->one();
        }

        return $activeRecord::find()->where($condition)->with($relations)->limit(1)->one();
    }
}