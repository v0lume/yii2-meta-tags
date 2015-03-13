<?php
/**
 * Created by PhpStorm.
 * User: artemshmanovsky
 * Date: 13.03.15
 * Time: 19:16
 */

namespace v0lume\yii2\metaTags;

use Yii;

class MetaTagsComponent extends \yii\base\Component {
    public static $behaviorName = 'MetaTag';

    public $generateCsrf = true;
    public $generateOg = true;


    public function register($model=null)
    {
        if($this->generateCsrf && Yii::$app->request->enableCsrfValidation)
        {
            Yii::$app->view->registerMetaTag(['name' => 'csrf-param', 'content' => Yii::$app->request->csrfParam], 'csrf-param');
            Yii::$app->view->registerMetaTag(['name' => 'csrf-token', 'content' => Yii::$app->request->csrfToken], 'csrf-token');
        }

        if(isset($model) && $model->getBehavior(self::$behaviorName))
        {
            $meta_tag = $model->getBehavior(self::$behaviorName)->model;

            Yii::$app->view->registerMetaTag(['name' => 'title', 'content' => $meta_tag->title], 'title');
            Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tag->keywords], 'keywords');
            Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tag->description], 'description');

            if($this->generateOg)
            {
                Yii::$app->view->registerMetaTag(['property' => 'og:title', 'content' => $meta_tag->title], 'og:title');
                Yii::$app->view->registerMetaTag(['property' => 'og:description', 'content' => $meta_tag->description], 'og:description');
                Yii::$app->view->registerMetaTag(['property' => 'og:url', 'content' => \yii\helpers\Url::to('', true)], 'og:url');
            }
        }
    }
}
