<?php

namespace kosuha606\Yii2BaseKit\Models\BusinessLogicModels\StaticData;

use kosuha606\Yii2BaseKit\Models\ActiveRecord\ActiveRecord;
use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\StaticData\modificators\StaticDataTypeModificator;
use kosuha606\Yii2BaseKit\Models\BusinessLogicModels\StaticData\services\StaticDataService;
use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class StaticData extends ActiveRecord
{
    const TYPE_STRING = 1;

    const TYPE_WYSWYG = 2;

    public $i18n = 'yii';

    public static $types = [
        self::TYPE_STRING => 'Строка',
        self::TYPE_WYSWYG => 'Текст WYSWYG',
    ];

    public $contentArray = [];

    public function init()
    {
        parent::init();
        $this->registerComponent(['staticDataService' => StaticDataService::class]);
        foreach ($this->contentArray as &$value) {
            $value = $this->content;
        }
    }

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
                'attribute' => 'name',
                'slugAttribute' => 'slug',
            ],
            [
                'class' => StaticDataTypeModificator::className(),
            ]
        ];
    }

    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['created_by', 'updated_by', 'created_at', 'updated_at', 'slug', 'type'], 'safe']
        ];
    }

    public static function tableName()
    {
        return 'static_data';
    }

    public function attributeLabels()
    {
        return [
            'name' => Yii::t($this->i18n, 'Name'),
            'content' => Yii::t($this->i18n, 'Content'),
            'type' => Yii::t($this->i18n, 'Type'),
            'slug' => Yii::t($this->i18n, 'Slug'),
            'created_by' => Yii::t($this->i18n, 'Created By'),
            'updated_by' => Yii::t($this->i18n, 'Updated By'),
            'created_at' => Yii::t($this->i18n, 'Created At'),
            'updated_at' => Yii::t($this->i18n, 'Updated At')
        ];
    }

    public function getService()
    {
        return Yii::$app->staticDataService;
    }

    public static function find()
    {
        return new StaticDataQuery(get_called_class());
    }
}