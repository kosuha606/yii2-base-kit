<?php

use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\ArticleCategory\ArticleCategory;
use yii\db\Migration;
use yii\db\mysql\Schema;

class m180819_142921_article_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(ArticleCategory::tableName(), [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING,
            'created_at' => 'timestamp NULL',
            'updated_at' => 'timestamp NULL',
            'created_by' => Schema::TYPE_INTEGER,
            'updated_by' => Schema::TYPE_INTEGER,
            'published' => Schema::TYPE_BOOLEAN,
            'slug' => Schema::TYPE_STRING,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(ArticleCategory::tableName());
    }
}
