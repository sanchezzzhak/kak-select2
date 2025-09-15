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
//               'theme' => 'juddy',
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
               'placeholder' => 'Страна',
               'multiple' => true,
               'clientOptions' => [
                   'allowClear' => true,
               ]
           ]) ?>
           <?=$form->field($model, 'cityId')->widget(Select2::class, [
               'items' => [],
               'multiple' => true,
           ]) ?>
       </div>
   </div>

    <style>
        /*.select2-container--juddy {*/

        /*}*/

        /*[class~=select2-container] .select2-selection--single {*/
        /*    padding: 0;*/
        /*}*/
        /*[class~=select2-container] .select2-selection--single .select2-selection__arrow {*/
        /*    border-left: none;*/
        /*    height: 26px;*/
        /*}*/
        /*[class~=select2-container] .select2-selection--single .select2-selection__placeholder {*/
        /*    color: #fff;*/
        /*}*/
        /*[class~=select2-container].select2-container--open .select2-selection, [class~=select2-container] .select2-selection:focus {*/
        /*    box-shadow: none;*/
        /*    border-color: #fff;*/
        /*}*/
        /*[class~=select2-container].select2-container--open.select2-container--below .select2-selection {*/
        /*    border-bottom-color: #fff;*/
        /*}*/
        /*[class~=select2-container] .select2-search--dropdown .select2-search__field {*/
        /*    border-radius: 0;*/
        /*    background: #fff;*/
        /*}*/
        /*.select2-container[class~=select2-container] {*/
        /*    margin-top: 1px;*/
        /*}*/
        /*.select2-selection__clear {*/
        /*    color: white !important;*/
        /*    top: 0 !important;*/
        /*}*/

        /*.select2-container--juddy .select2-results__option[aria-selected]{*/
        /*    background-color: #10131bd9;*/
        /*    color: #fff;*/
        /*}*/

        /*.select2-container--default .select2-results__option[aria-selected=true],*/
        /*.select2-container--juddy .select2-results__option[aria-selected=true],*/
        /*.select2-container--juddy li.select2-results__option{*/
        /*    background-color: #41445b70;*/
        /*    color: #fff;*/
        /*}*/

        /*.select2-container--default .select2-results__option--highlighted[aria-selected],*/
        /*.select2-container--juddy .select2-results__option--highlighted[aria-selected] {*/
        /*    background-color: #41445b70;*/
        /*}*/

        /*.select2-container .select2-selection--single {*/
        /*    height: 40px;*/
        /*    border: 2px solid #007bff;*/
        /*    border-radius: 8px;*/
        /*    background-color: #f8f9fa;*/
        /*}*/

        /*.select2-container .select2-selection--single .select2-selection__rendered {*/
        /*    line-height: 36px; !* Выравнивание текста по вертикали *!*/
        /*    color: #333;*/
        /*    font-size: 16px;*/
        /*}*/

        /*.select2-container .select2-selection--single .select2-selection__arrow {*/
        /*    height: 36px;*/
        /*    right: 8px;*/
        /*}*/

        /*.select2-container .select2-selection--single .select2-selection__arrow b {*/
        /*    border-color: #007bff transparent transparent transparent;*/
        /*}*/
        /*.select2-container .select2-dropdown {*/
        /*    border: 2px solid #007bff;*/
        /*    border-radius: 8px;*/
        /*    box-shadow: 0 4px 12px rgba(0,0,0,0.15);*/
        /*}*/

        /*.select2-container .select2-results__option {*/
        /*    padding: 10px 12px;*/
        /*    font-size: 15px;*/
        /*    color: #333;*/
        /*}*/

        /*.select2-container .select2-results__option--highlighted[aria-selected] {*/
        /*    background-color: #007bff;*/
        /*    color: white;*/
        /*}*/

        /*.select2-container .select2-results__option[aria-selected="true"] {*/
        /*    background-color: #e9ecef;*/
        /*    color: #007bff;*/
        /*}*/
        /*.select2-container .select2-selection--multiple {*/
        /*    border: 2px solid #28a745;*/
        /*    border-radius: 8px;*/
        /*    min-height: 40px;*/
        /*}*/

        /*.select2-container .select2-selection--multiple .select2-selection__rendered {*/
        /*    display: flex;*/
        /*    flex-wrap: wrap;*/
        /*    gap: 4px;*/
        /*    padding: 4px 8px;*/
        /*}*/

        /*.select2-container .select2-selection--multiple .select2-selection__choice {*/
        /*    background-color: #28a745;*/
        /*    color: white;*/
        /*    border-radius: 4px;*/
        /*    padding: 2px 8px;*/
        /*    font-size: 14px;*/
        /*}*/

        /*.select2-container .select2-selection--multiple .select2-selection__choice__remove {*/
        /*    color: white;*/
        /*    margin-left: 6px;*/
        /*    cursor: pointer;*/
        /*}*/

        /*.select2-container .select2-selection--multiple .select2-selection__choice__remove:hover {*/
        /*    color: #ffdddd;*/
        /*}*/
    </style>


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