Select2 widgets
================
Select2 widgets for Yii2

Preview
------------
<img src="https://lh3.googleusercontent.com/-SYtyKxfvZz4/VbCwEPzvxEI/AAAAAAAAAC4/Or5c1ObK7EM/s339-Ic42/select2Preview.png">

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist kak/select2 "dev-master"
```

or add

```
"kak/select2": "dev-master"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php

<?= \kak\widgets\select2\Select2::widget([
   'toggleEnable' => false,            // visible select all/unselect all
   'selectLabel' => 'select all',
   'unselectLabel' => 'unselect all',
   'multiple' => true,
   'value' => ['val1','val2'],
   'name' => 'inputName',
   'items' => [
        'val1' => 'options1',
        'val2' => 'options2',
        'val3' => 'options3',
        'val4' => 'options4',
   ],
]); ?>
```

```php

<?= $form->field($model, 'list')->widget('\kak\widgets\select2\Select2', [
    'items' => [
        'val1' => 'options1',
        'val2' => 'options2',
        'val3' => 'options3',
        'val4' => 'options4',
    ],
    'options' => [
        'class' => 'myCssClass'
    ],
    'clientOptions' => [],   // js options select2
]) ?>

```

