<?php
/**
 * Created by PhpStorm.
 * User: artemshmanovsky
 * Date: 12.03.15
 * Time: 2:11
 */

namespace v0lume\yii2\metaTags\models;

use Yii;
use yii\behaviors\TimestampBehavior;

class MetaTag extends \yii\db\ActiveRecord
{
    /**
     * @return string the associated database table name
     */
    public static function tableName()
    {
        return '{{%meta_tags}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            [['model', 'model_id'], 'required'],
            [['model_id', 'time_update'], 'integer'],
            ['description', 'string'],
            [['model', 'title', 'keywords'], 'string', 'max' => 255],
            [['model', 'model_id', 'title', 'keywords', 'description'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Заголовок',
            'keywords' => 'Ключевые слова',
            'description' => 'Описание',
        ];
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => false,
                'updatedAtAttribute' => 'time_update',
            ],
        ];
    }
}