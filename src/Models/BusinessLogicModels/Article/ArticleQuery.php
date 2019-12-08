<?php

namespace kosuha606\Yii2BaseKit\Models\BusinessLogicModels\Article;

use yii\db\ActiveQuery;

class ArticleQuery extends ActiveQuery
{
    public function published()
    {
        return $this->andwhere(['published' => 1]);
    }

    public function numberOfLatest($number)
    {
        return $this->orderBy('created_at DESC')->limit($number)->all();
    }

    public function byUrl($url)
    {
        $parts = explode('-', $url);
        $id = array_shift($parts);
        $slug = implode('-', $parts);

        return $this->andWhere(['id' => $id, 'slug' => $slug])->limit(1)->one();
    }

    public function category($categoryId)
    {
        return $this->andWhere(['article_category_id' => $categoryId]);
    }

    public function createdOrder($sort = 'DESC')
    {
        return $this->orderBy("created_at $sort");
    }
}