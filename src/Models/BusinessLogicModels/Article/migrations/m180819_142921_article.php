<?php

use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\Article\Article;
use yii\db\Migration;
use yii\db\Schema;

class m180819_142921_article extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(Article::tableName(), [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING,
            'list_image_src' => Schema::TYPE_STRING,
            'detail_image_src' => Schema::TYPE_STRING,
            'article_category_id' => Schema::TYPE_STRING,
            'created_at' => 'timestamp NULL',
            'updated_at' => 'timestamp NULL',
            'created_by' => Schema::TYPE_INTEGER,
            'updated_by' => Schema::TYPE_INTEGER,
            'content' => Schema::TYPE_TEXT,
            'published' => Schema::TYPE_BOOLEAN,
            'slug' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(Article::tableName());
    }
}
