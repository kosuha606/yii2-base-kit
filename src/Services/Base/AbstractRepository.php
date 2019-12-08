<?php

namespace kosuha606\Yii2BaseKit\Services\Base;

use yii\db\Query;

class AbstractRepository
{
    public function filter(Query $query, $filterField, $filterValue)
    {

    }

    /**
     * Создание связи многие-ко-многим
     * @param array $relatedEntities
     */
    public function createManyToManyRelation($entity, $relatedEntities = [])
    {

    }

    public function createOneToManyRelation($entity, $relatedEntity)
    {

    }
}