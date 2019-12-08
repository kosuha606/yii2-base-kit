<?php

namespace kosuha606\Yii2BaseKit\Models\BusinessLogicModels\ArticleCategory;

use yii\db\ActiveQuery;

class ArticleCategoryQuery extends ActiveQuery
{
    public function published()
    {
        return $this->andwhere(['published' => 1]);
    }

    public function byUrl($url)
    {
        $parts = explode('-', $url);
        $id = array_shift($parts);
        $slug = implode('-', $parts);

        return $this->andWhere(['id' => $id, 'slug' => $slug])->limit(1);
    }
}