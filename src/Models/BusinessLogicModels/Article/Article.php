<?php

namespace kosuha606\Yii2BaseKit\Models\BusinessLogicModels\Article;

use kosuha606\Yii2BaseKit\Behaviours\UrlBehaviour\UrlBehaviour;
use kosuha606\Yii2BaseKit\Models\ActiveRecord\ActiveRecord;
use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\ArticleCategory\ArticleCategory;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yiidreamteam\upload\FileUploadBehavior;

class Article extends ActiveRecord
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
                'class' => SluggableBehavior::className(),
                'attribute' => 'title',
                'slugAttribute' => 'slug',
            ],
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'list_image_src',
                'filePath' => '@webroot/uploads/list_image_src[[pk]]_[[filename]].[[extension]]',
                'fileUrl' => '/uploads/list_image_src[[pk]]_[[filename]].[[extension]]',
            ],
            [
                'class' => FileUploadBehavior::class,
                'attribute' => 'detail_image_src',
                'filePath' => '@webroot/uploads/detail_image_src[[pk]]_[[filename]].[[extension]]',
                'fileUrl' => '/uploads/detail_image_src[[pk]]_[[filename]].[[extension]]',
            ],
            [
                'class' => UrlBehaviour::class,
            ]
        ];
    }

    public static function tableName()
    {
        return 'article';
    }

    public function attributeLabels()
    {
        return [
            'title' => Yii::t($this->i18n, 'Title'),
            'content' => Yii::t($this->i18n, 'Content'),
            'published' => Yii::t($this->i18n, 'Published'),
            'list_image_src' => Yii::t($this->i18n, 'List Image'),
            'detail_image_src' => Yii::t($this->i18n, 'Detail Image'),
            'article_category_id' => Yii::t($this->i18n, 'Category'),
            'created_by' => Yii::t($this->i18n, 'Created By'),
            'updated_by' => Yii::t($this->i18n, 'Updated By'),
            'created_at' => Yii::t($this->i18n, 'Created At'),
            'updated_at' => Yii::t($this->i18n, 'Updated At')
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['list_image_src', 'detail_image_src'], 'file'],
            [['article_category_id'], 'integer'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'published'], 'safe']
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(ArticleCategory::class, ['id' => 'article_category_id']);
    }

    public function getImage($type)
    {
        $uploads = \Yii::getAlias('@webroot/uploads/');
        $imgFile = $type . $this->id . '_' . $this->$type;
        if (is_file($uploads . '/' . $imgFile)) {
            return '/uploads/' . $imgFile;
        }

        return null;
    }

    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }
}