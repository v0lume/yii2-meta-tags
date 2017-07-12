<?php
/**
 * Created by PhpStorm.
 * User: artemshmanovsky
 * Date: 12.03.15
 * Time: 1:52
 */

namespace v0lume\yii2\metaTags;

use Yii;
use yii\base\Behavior;
use yii\db\ActiveRecord;

use v0lume\yii2\metaTags\models\MetaTag;
use yii\web\Request;

class MetaTagBehavior extends Behavior
{
    private $_model = null;


    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
        ];
    }


    public function afterSave($event)
    {
        if(Yii::$app->request instanceof Request){
            $attributes = Yii::$app->request->post('MetaTag', Yii::$app->request->get('MetaTag', null) );

            if($attributes)
            {
                $model = $this->getModel();

                if(!isset($model))
                    $model = new MetaTag();

                $attributes['model_id'] = $this->owner->id;
                $attributes['model']  = (new \ReflectionClass($this->owner))->getShortName();

                $model->attributes = $attributes;
                $model->save();
            }
        }
    }


    public function afterDelete($event)
    {
        MetaTag::deleteAll([
            'model_id' => $this->owner->id,
            'model'  => (new \ReflectionClass($this->owner))->getShortName()
        ]);
    }


    public function getModel()
    {
        $model = MetaTag::findOne([
            'model_id' => $this->owner->id,
            'model'  => (new \ReflectionClass($this->owner))->getShortName()
        ]);

        if($model == null)
            $model = new MetaTag();

        $this->_model = $model;

        return $model;
    }


    public function getTitle()
    {
        $model = $this->_model;
        if(!isset($model))
            $model = $this->getModel();

        return isset($model) ? $model->title : '';
    }

    public function getDescription()
    {
        $model = $this->_model;
        if(!isset($model))
            $model = $this->getModel();

        return isset($model) ? $model->description : '';
    }

    public function getKeywords()
    {
        $model = $this->_model;
        if(!isset($model))
            $model = $this->getModel();

        return isset($model) ? $model->keywords : '';
    }
}
