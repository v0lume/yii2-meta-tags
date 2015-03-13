# yii2-meta-tags
DB based model meta data for SEO

![screenshot](https://cloud.githubusercontent.com/assets/5075100/6626492/fc4a689e-c907-11e4-85aa-af653a455ad0.jpg)

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```php 
composer.phar require --prefer-dist v0lume/yii2-meta-tags "*"
```

or add

```
"v0lume/yii2-meta-tags": "*"
```

to the require section of your `composer.json` file.

Usage
------------

Add `MetaTagBehavior` to your model, and configure it.

```php

public function behaviors()
{
    return [
        'MetaTag' => [
            'class' => MetaTagBehavior::className(),
        ],
    ];
}
```

Add `MetaTags` somewhere in you application, for example in editing form.

```php
echo MetaTags::widget([
    'model' => $model,
    'form' => $form
]);
```

Done! Now, you can get meta data of your current model:

```php
echo $model->getBehavior('MetaTag')->title;
echo $model->getBehavior('MetaTag')->keywords;
echo $model->getBehavior('MetaTag')->description;
```

Or, by manually find model:

```php
use v0lume\yii2\metaTags\model\MetaTag;

...

$meta_tag = MetaTag::findOne([
    'model_id' => $id,
    'model'  => (new \ReflectionClass($model))->getShortName()
]);

...

echo $meta_tag->title;
echo $meta_tag->keywords;
echo $meta_tag->description;
```

Auto registration meta tags
------------
You can use `MetaTagsComponent` to perform auto registration meta tags

Configure `MetaTagsComponent` in `main.php` config:

```php

...
'components' => [
    ...
    'metaTags' => [
        'class' => 'v0lume\yii2\metaTags\MetaTagsComponent',
        'generateCsrf' => false,
        'generateOg' => true,
    ],
    ...
],
...
    
```

And then, in your layouts or views or controller action

```php
$model = \common\models\Page::findOne(['url' => '/']);

Yii::$app->metaTags->register($model);
```

If passed $model was attached `MetaTagBehavior`, component will register meta tags for that model. If `MetaTagBehavior` wasn't attached or model not passed, and `generateCsrf` is set to true, component will generate only csrf meta tags.
