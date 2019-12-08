<?php

namespace kosuha606\Yii2BaseKit\Models\BusinessLogicModels\Article\search;

use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\Article\Article;
use vintage\search\interfaces\SearchInterface;
use yii\helpers\StringHelper;

class ArticleSearch extends Article implements SearchInterface
{
    /**
     * @inheritdoc
     */
    public function getSearchTitle()
    {

        return $this->title;
    }

    /**
     * @inheritdoc
     */
    public function getSearchDescription()
    {
        return StringHelper::truncate($this->content, 200);
    }

    /**
     * @inheritdoc
     */
    public function getSearchUrl()
    {
        return '/article/'.$this->getUrl();
    }

    /**
     * @inheritdoc
     */
    public function getSearchFields()
    {
        return [
            'title',
            'content',
        ];
    }
}