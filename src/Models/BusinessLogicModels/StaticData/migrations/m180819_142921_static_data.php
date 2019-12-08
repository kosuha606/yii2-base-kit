<?php

use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\StaticData\StaticData;
use yii\db\Migration;
use yii\db\Schema;

class m180819_142921_static_data extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(StaticData::tableName(), [
            'id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING,
            'content' => Schema::TYPE_TEXT,
            'slug' => Schema::TYPE_STRING,
            'created_at' => 'timestamp NULL',
            'updated_at' => 'timestamp NULL',
            'created_by' => Schema::TYPE_INTEGER,
            'updated_by' => Schema::TYPE_INTEGER,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(StaticData::tableName());
    }
}
