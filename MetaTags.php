<?php
/**
 * Created by PhpStorm.
 * User: artemshmanovsky
 * Date: 11.03.15
 * Time: 15:03
 */

namespace v0lume\yii2\metaTags;

use Yii;
use yii\base\Widget;
use yii\base\Exception;

use v0lume\yii2\metaTags\models\MetaTag;


class MetaTags extends Widget
{
    public $behaviorName = 'MetaTag';

    public $model;
    public $form;


    public function init()
    {
        parent::init();
        self::registerTranslations();

        if (!$this->model->getBehavior($this->behaviorName))
        {
            throw new Exception(self::t('messages', 'widget_behavior_exception {behaviorName}', ['behaviorName' => $this->behaviorName]), 500);
        }
    }


    public static function registerTranslations()
    {
        $i18n = Yii::$app->i18n;
        $i18n->translations['metaTags/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'sourceLanguage' => 'sys',
            'basePath' => '@vendor/v0lume/yii2-meta-tags/messages',
            'fileMap' => [
                'metaTags/messages' => 'messages.php',
            ],
        ];
    }


    public function run()
    {
        $model = new MetaTag;

        if(!$this->model->isNewRecord)
        {
            $meta_tag = MetaTag::findOne([
                'model_id' => $this->model->id,
                'model'  => (new \ReflectionClass($this->model))->getShortName()
            ]);

            if(isset($meta_tag))
                $model = $meta_tag;
        }

        return $this->render('MetaTags', [
            'model' => $model,
            'form' => $this->form,
        ]);
    }


    public static function t($category, $message, $params = [], $language = null)
    {
        self::registerTranslations();

        return Yii::t('metaTags/' . $category, $message, $params, $language);
    }
}