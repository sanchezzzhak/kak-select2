<?php

use app\models\TestModel;
use kak\widgets\select2\Select2;
use yii\widgets\ActiveForm;

/**
 * @var TestModel $model
 **/

?>


<hr>

<?php $form = ActiveForm::begin() ?>

   <div class="row">
       <div class="col-md-4">
           <?=$form->field($model, 'countryId')->widget(Select2::class, [
               'items' => [
                   'AU' => 'Австралия',
                   'AT' => 'Австрия',
                   'AZ' => 'Азербайджан',
                   'AX' => 'Аландские острова',
                   'AL' => 'Албания',
                   'DZ' => 'Алжир',
                   'VI' => 'Виргинские Острова (США)',
                   'AS' => 'Американское Самоа',
                   'AI' => 'Ангилья',
                   'AO' => 'Ангола',
                   'AD' => 'Андорра',
                   'AQ' => 'Антарктида',
                   'AG' => 'Антигуа и Барбуда',
                   'AR' => 'Аргентина',
                   'AM' => 'Армения',
                   'AW' => 'Аруба',
                   'AF' => 'Афганистан',
                   'BS' => 'Багамы',
                   'BD' => 'Бангладеш',
                   'BB' => 'Барбадос',
               ],
               'multiple' => true,
           ]) ?>
           <?=$form->field($model, 'cityId')->widget(Select2::class, [
               'items' => [],
               'multiple' => true,
           ]) ?>
       </div>
   </div>


    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>
    <br><br>

<?php ActiveForm::end() ?>