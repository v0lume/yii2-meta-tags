# yii2-meta-tags
DB based model meta data for SEO


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist v0lume/yii2-meta-tags "*"
```

or add

```
"v0lume/yii2-meta-tags": "*"
```

to the require section of your `composer.json` file.

Usage
------------

Add MetaTagBehavior to your model, and configure it.

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

Add MetaTags somewhere in you application, for example in editing form.

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