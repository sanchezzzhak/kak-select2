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
php composer.phar require --prefer-dist kak/select2 "*"
```

or add

```
"kak/select2": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \kak\widgets\Select2::widget(); ?>
```

```php
<?= $form->field($model, 'list')->widget('\kak\widgets\Select2', [
    'items' => [],
    'options' => [
        'class' => 'myCssClass'
    ],
    'clientOptions' => [],
]) ?>
```