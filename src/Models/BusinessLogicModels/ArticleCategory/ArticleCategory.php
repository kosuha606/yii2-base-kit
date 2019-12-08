<?php

namespace kosuha606\Yii2BaseKit\Models\BusinessLogicModels\ArticleCategory;

use kosuha606\Yii2BaseKit\Behaviours\UrlBehaviour\UrlBehaviour;
use kosuha606\Yii2BaseKit\Models\ActiveRecord\ActiveRecord;
use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\Article\Article;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class ArticleCategory extends ActiveRecord
{
    public $i18n = 'yii';

    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
            [
                'class' => UrlBehaviour::class,
            ]
        ];
    }

    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'published', 'slug'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => Yii::t($this->i18n, 'Title'),
            'created_by' => Yii::t($this->i18n, 'Created By'),
            'updated_by' => Yii::t($this->i18n, 'Updated By'),
            'created_at' => Yii::t($this->i18n, 'Created At'),
            'updated_at' => Yii::t($this->i18n, 'Updated At'),
            'published' => Yii::t($this->i18n, 'Published'),
        ];
    }

    public function getArticles()
    {
        return $this->hasMany(Article::class, ['article_category_id' => 'id']);
    }

    public static function find()
    {
        return new ArticleCategoryQuery(get_called_class());
    }
}
