<?php

use app\models\TestModel;
use kak\widgets\select2\Select2;
use yii\widgets\ActiveForm;

/**
 * @var TestModel $model
 **/

$items = [
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
];

?>


<hr>

<?php $form = ActiveForm::begin() ?>

   <div class="row filter-block back-grey">
       <div class="col-md-4">
           <?=$form->field($model, 'countryId')->widget(Select2::class, [
               'theme' => 'default',
               'items' => $items,
               'placeholder' => 'Страна',
               'multiple' => true,
               'clientOptions' => [
                   'allowClear' => true,
               ],
               'options' => [
               ]

           ]) ?>
           <?=$form->field($model, 'cityId')->widget(Select2::class, [
               'theme' => 'default',
               'items' => $items,
               'multiple' => false,
           ]) ?>
       </div>
   </div>

    <style>

        body {
            background: red;
        }

        ::-webkit-scrollbar-track {
            background-color: #10131b;
        }
        ::-webkit-scrollbar-thumb {
            background-color: rgba(98, 98, 98, .5);
        }
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }


        .filter-block.back-grey {
            background: #191d2a; }


        /** select min ****/

        /*** select2 overwrite ***/


        body>.select2-container {
            max-width: 300px}
        .input {
            width: 100%;
            background: transparent;
            border-radius: 0;
            border: 0;
            border-bottom: 1px solid #ffffff;
            height: 20px;
            color: #fff;
            padding: 0 5px;
            font-size: 10px;
            margin-bottom: -4px; }

        .select2-container {
            width: 100% !important; }
        .select2-container.select2-container--open .select2-selection--single .select2-selection__arrow b {
            -ms-transform: rotate(180deg);
            transform: rotate(180deg); }

        /*.select2-container--default.select2-container--focus .select2-selection--multiple {*/
        /*    */
        /*    border-bottom: 1px solid #fff;*/
        /*}*/
        .select2-container .select2-selection--multiple {
            background: transparent;
            border: 0;
            border-bottom: 1px solid #fff;
            border-radius: 0;
            overflow-y: auto;
        }
        .select2-container .select2-selection--single {
            background: transparent;
            border: 0;
            border-bottom: 1px solid #fff;
            border-radius: 0; }

        .select2-container .select2-selection--single .select2-selection__arrow b {
            display: inline-block;
            border-color: transparent !important;
            border-width: 0 !important;
            background: url(../img/arrow.svg);
            background-position: center;
            width: 20px;
            height: 20px;
            min-width: 10px;
            margin-top: -10px;
            -ms-transform: rotate(0deg);
            transform: rotate(0deg);
            transition: all .3s ease-in;
            background-size: 12px;
            background-repeat: no-repeat;
            filter: drop-shadow(0px 0px 3px white); }

        .select2-container .select2-selection--single .select2-selection__rendered {
            color: #fff;
            line-height: 28px;
            font-size: 11px;
            text-transform: uppercase;
            padding-left: 0px; }

        .select2-container--classic .select2-selection--multiple {
            background: transparent;
        }


        .select2-container--default.select2-container--disabled .select2-selection--single {
            background-color: transparent; }
        .select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__rendered {
            color: #ffffff50; }

        .select2-dropdown {
            background-color: #10131bd9;
            border: 0 solid #fff;
            border-radius: 0;
            min-width: 120px; }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #41445b70;
            color: white; }

        .select2-results__option--selectable {
            cursor: pointer;
            color: #fff;
            font-size: 14px;
            max-width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis; }

        .select2-results__option {
            padding: 5px 10px;
            color: #fff }

        [class~=select2-container] {
            min-height: 32px;
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #41445b70; }

        [class~=select2-container] .select2-selection--single {
            padding: 0 6px;
        }
        [class~=select2-container] .select2-selection--single .select2-selection__arrow {
            border-left: none;
            height: 26px;
        }
        [class~=select2-container] .select2-selection--single .select2-selection__placeholder {
            color: #fff;
        }
        [class~=select2-container].select2-container--open .select2-selection, [class~=select2-container] .select2-selection:focus {
            box-shadow: none;
            border-color: #fff;
        }
        [class~=select2-container].select2-container--open.select2-container--below .select2-selection {
            border-bottom-color: #fff;
        }
        [class~=select2-container] .select2-search--dropdown .select2-search__field {
            border-radius: 0;
            background: #fff;
        }
        .select2-container--default .select2-selection--multiple {
            background-color: transparent;
        }
        .select2-container[class~=select2-container] {
            margin-top: 1px;
        }
        .select2-selection__clear {
            color: white !important;
            top: 0 !important;
        }

        .select2-container--default .select2-results__option[aria-selected]{
            background-color: #10131bd9;
            color: #fff;
        }

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