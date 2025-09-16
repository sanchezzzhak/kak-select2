<?php

use app\models\TestModel;
use kak\widgets\select2\Select2;
use yii\widgets\ActiveForm;

/**
 * @var TestModel $model
 **/
\kak\widgets\select2\SlimScrollAsset::register($this);
?>


<hr>

<?php $form = ActiveForm::begin() ?>

   <div class="row filter-block back-grey">
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
               'placeholder' => 'Страна',
               'multiple' => true,
               'clientOptions' => [
                   'allowClear' => true,
               ],
               'options' => [
               ]

           ]) ?>
           <?=$form->field($model, 'cityId')->widget(Select2::class, [
               'items' => [],
               'multiple' => true,
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

        .select2-container {
            box-sizing: border-box;
            display: inline-block;
            margin: 0;
            position: relative;
            vertical-align: middle
        }

        .select2-container .select2-selection--single {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            height: 28px;
            user-select: none;
            -webkit-user-select: none
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            display: block;
            padding-left: 8px;
            padding-right: 20px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap
        }

        .select2-container .select2-selection--single .select2-selection__clear {
            background-color: transparent;
            border: none;
            font-size: 1em
        }

        .select2-container[dir="rtl"] .select2-selection--single .select2-selection__rendered {
            padding-right: 8px;
            padding-left: 20px
        }

        .select2-container .select2-selection--multiple {
            box-sizing: border-box;
            cursor: pointer;
            display: block;
            min-height: 32px;
            user-select: none;
            -webkit-user-select: none
        }

        .select2-container .select2-selection--multiple .select2-selection__rendered {
            display: inline;
            list-style: none;
            padding: 0
        }

        .select2-container .select2-selection--multiple .select2-selection__clear {
            background-color: transparent;
            border: none;
            font-size: 1em
        }

        .select2-container .select2-search--inline .select2-search__field {
            box-sizing: border-box;
            border: none;
            font-size: 100%;
            margin-top: 5px;
            margin-left: 5px;
            padding: 0
        }

        .select2-container .select2-search--inline .select2-search__field::-webkit-search-cancel-button {
            -webkit-appearance: none
        }

        .select2-dropdown {
            background-color: white;
            border: 1px solid #aaa;
            border-radius: 4px;
            box-sizing: border-box;
            display: block;
            position: absolute;
            left: -100000px;
            width: 100%;
            z-index: 1051
        }

        .select2-results {
            display: block
        }

        .select2-results__options {
            list-style: none;
            margin: 0;
            padding: 0
        }

        .select2-results__option {
            padding: 6px;
            user-select: none;
            -webkit-user-select: none
        }

        .select2-results__option--selectable {
            cursor: pointer
        }

        .select2-container--open .select2-dropdown {
            left: 0
        }

        .select2-container--open .select2-dropdown--above {
            border-bottom: none;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0
        }

        .select2-container--open .select2-dropdown--below {
            border-top: none;
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .select2-search--dropdown {
            display: block;
            padding: 4px
        }

        .select2-search--dropdown .select2-search__field {
            padding: 4px;
            width: 100%;
            box-sizing: border-box
        }

        .select2-search--dropdown .select2-search__field::-webkit-search-cancel-button {
            -webkit-appearance: none
        }

        .select2-search--dropdown.select2-search--hide {
            display: none
        }

        .select2-close-mask {
            border: 0;
            margin: 0;
            padding: 0;
            display: block;
            position: fixed;
            left: 0;
            top: 0;
            min-height: 100%;
            min-width: 100%;
            height: auto;
            width: auto;
            opacity: 0;
            z-index: 99;
            background-color: #fff;
            filter: alpha(opacity=0)
        }

        .select2-hidden-accessible {
            border: 0 !important;
            clip: rect(0 0 0 0) !important;
            -webkit-clip-path: inset(50%) !important;
            clip-path: inset(50%) !important;
            height: 1px !important;
            overflow: hidden !important;
            padding: 0 !important;
            position: absolute !important;
            width: 1px !important;
            white-space: nowrap !important
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 28px
        }

        .select2-container--default .select2-selection--single .select2-selection__clear {
            cursor: pointer;
            float: right;
            font-weight: bold;
            height: 26px;
            margin-right: 20px;
            padding-right: 0px
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #999
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #888 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 50%;
            margin-left: -4px;
            margin-top: -2px;
            position: absolute;
            top: 50%;
            width: 0
        }

        .select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__clear {
            float: left
        }

        .select2-container--default[dir="rtl"] .select2-selection--single .select2-selection__arrow {
            left: 1px;
            right: auto
        }

        .select2-container--default.select2-container--disabled .select2-selection--single {
            background-color: #eee;
            cursor: default
        }

        .select2-container--default.select2-container--disabled .select2-selection--single .select2-selection__clear {
            display: none
        }

        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #888 transparent;
            border-width: 0 4px 5px 4px
        }

        .select2-container--default .select2-selection--multiple {
            background-color: white;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: text;
            padding-bottom: 5px;
            padding-right: 5px
        }

        .select2-container--default .select2-selection--multiple .select2-selection__clear {
            cursor: pointer;
            float: right;
            font-weight: bold;
            height: 20px;
            margin-right: 10px;
            margin-top: 5px;
            padding: 1px
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #e4e4e4;
            border: 1px solid #aaa;
            border-radius: 4px;
            display: inline-block;
            margin-left: 5px;
            margin-top: 5px;
            padding: 0
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            cursor: default;
            padding-left: 2px;
            padding-right: 5px
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            background-color: transparent;
            border: none;
            border-right: 1px solid #aaa;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
            color: #999;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            padding: 0 4px
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover, .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus {
            background-color: #f1f1f1;
            color: #333;
            outline: none
        }

        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice {
            margin-left: 5px;
            margin-right: auto
        }

        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__display {
            padding-left: 5px;
            padding-right: 2px
        }

        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove {
            border-left: 1px solid #aaa;
            border-right: none;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px
        }

        .select2-container--default[dir="rtl"] .select2-selection--multiple .select2-selection__clear {
            float: left;
            margin-left: 10px;
            margin-right: auto
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border: solid black 1px;
            outline: 0
        }

        .select2-container--default.select2-container--disabled .select2-selection--multiple {
            background-color: #eee;
            cursor: default
        }

        .select2-container--default.select2-container--disabled .select2-selection__choice__remove {
            display: none
        }

        .select2-container--default.select2-container--open.select2-container--above .select2-selection--single, .select2-container--default.select2-container--open.select2-container--above .select2-selection--multiple {
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .select2-container--default.select2-container--open.select2-container--below .select2-selection--single, .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #aaa
        }

        .select2-container--default .select2-search--inline .select2-search__field {
            background: transparent;
            border: none;
            outline: 0;
            box-shadow: none;
            -webkit-appearance: textfield
        }

        .select2-container--default .select2-results > .select2-results__options {
            max-height: 200px;
            overflow-y: auto
        }

        .select2-container--default .select2-results__option .select2-results__option {
            padding-left: 1em
        }

        .select2-container--default .select2-results__option .select2-results__option .select2-results__group {
            padding-left: 0
        }

        .select2-container--default .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -1em;
            padding-left: 2em
        }

        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -2em;
            padding-left: 3em
        }

        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -3em;
            padding-left: 4em
        }

        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -4em;
            padding-left: 5em
        }

        .select2-container--default .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option .select2-results__option {
            margin-left: -5em;
            padding-left: 6em
        }

        .select2-container--default .select2-results__option--group {
            padding: 0
        }

        .select2-container--default .select2-results__option--disabled {
            color: #999
        }

        .select2-container--default .select2-results__option--selected {
            background-color: #ddd
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #5897fb;
            color: white
        }

        .select2-container--default .select2-results__group {
            cursor: default;
            display: block;
            padding: 6px
        }

        .select2-container--classic .select2-selection--single {
            background-color: #f7f7f7;
            border: 1px solid #aaa;
            border-radius: 4px;
            outline: 0;
            background-image: -webkit-linear-gradient(top, #fff 50%, #eee 100%);
            background-image: -o-linear-gradient(top, #fff 50%, #eee 100%);
            background-image: linear-gradient(to bottom, #fff 50%, #eee 100%);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0)
        }

        .select2-container--classic .select2-selection--single:focus {
            border: 1px solid #5897fb
        }

        .select2-container--classic .select2-selection--single .select2-selection__rendered {
            color: #444;
            line-height: 28px
        }

        .select2-container--classic .select2-selection--single .select2-selection__clear {
            cursor: pointer;
            float: right;
            font-weight: bold;
            height: 26px;
            margin-right: 20px
        }

        .select2-container--classic .select2-selection--single .select2-selection__placeholder {
            color: #999
        }

        .select2-container--classic .select2-selection--single .select2-selection__arrow {
            background-color: #ddd;
            border: none;
            border-left: 1px solid #aaa;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px;
            height: 26px;
            position: absolute;
            top: 1px;
            right: 1px;
            width: 20px;
            background-image: -webkit-linear-gradient(top, #eee 50%, #ccc 100%);
            background-image: -o-linear-gradient(top, #eee 50%, #ccc 100%);
            background-image: linear-gradient(to bottom, #eee 50%, #ccc 100%);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFCCCCCC', GradientType=0)
        }

        .select2-container--classic .select2-selection--single .select2-selection__arrow b {
            border-color: #888 transparent transparent transparent;
            border-style: solid;
            border-width: 5px 4px 0 4px;
            height: 0;
            left: 50%;
            margin-left: -4px;
            margin-top: -2px;
            position: absolute;
            top: 50%;
            width: 0
        }

        .select2-container--classic[dir="rtl"] .select2-selection--single .select2-selection__clear {
            float: left
        }

        .select2-container--classic[dir="rtl"] .select2-selection--single .select2-selection__arrow {
            border: none;
            border-right: 1px solid #aaa;
            border-radius: 0;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
            left: 1px;
            right: auto
        }

        .select2-container--classic.select2-container--open .select2-selection--single {
            border: 1px solid #5897fb
        }

        .select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow {
            background: transparent;
            border: none
        }

        .select2-container--classic.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #888 transparent;
            border-width: 0 4px 5px 4px
        }

        .select2-container--classic.select2-container--open.select2-container--above .select2-selection--single {
            border-top: none;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            background-image: -webkit-linear-gradient(top, #fff 0%, #eee 50%);
            background-image: -o-linear-gradient(top, #fff 0%, #eee 50%);
            background-image: linear-gradient(to bottom, #fff 0%, #eee 50%);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFFFFFFF', endColorstr='#FFEEEEEE', GradientType=0)
        }

        .select2-container--classic.select2-container--open.select2-container--below .select2-selection--single {
            border-bottom: none;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
            background-image: -webkit-linear-gradient(top, #eee 50%, #fff 100%);
            background-image: -o-linear-gradient(top, #eee 50%, #fff 100%);
            background-image: linear-gradient(to bottom, #eee 50%, #fff 100%);
            background-repeat: repeat-x;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#FFEEEEEE', endColorstr='#FFFFFFFF', GradientType=0)
        }

        .select2-container--classic .select2-selection--multiple {
            background-color: white;
            border: 1px solid #aaa;
            border-radius: 4px;
            cursor: text;
            outline: 0;
            padding-bottom: 5px;
            padding-right: 5px
        }

        .select2-container--classic .select2-selection--multiple:focus {
            border: 1px solid #5897fb
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__clear {
            display: none
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__choice {
            background-color: #e4e4e4;
            border: 1px solid #aaa;
            border-radius: 4px;
            display: inline-block;
            margin-left: 5px;
            margin-top: 5px;
            padding: 0
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__choice__display {
            cursor: default;
            padding-left: 2px;
            padding-right: 5px
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove {
            background-color: transparent;
            border: none;
            border-top-left-radius: 4px;
            border-bottom-left-radius: 4px;
            color: #888;
            cursor: pointer;
            font-size: 1em;
            font-weight: bold;
            padding: 0 4px
        }

        .select2-container--classic .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #555;
            outline: none
        }

        .select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice {
            margin-left: 5px;
            margin-right: auto
        }

        .select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice__display {
            padding-left: 5px;
            padding-right: 2px
        }

        .select2-container--classic[dir="rtl"] .select2-selection--multiple .select2-selection__choice__remove {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            border-top-right-radius: 4px;
            border-bottom-right-radius: 4px
        }

        .select2-container--classic.select2-container--open .select2-selection--multiple {
            border: 1px solid #5897fb
        }

        .select2-container--classic.select2-container--open.select2-container--above .select2-selection--multiple {
            border-top: none;
            border-top-left-radius: 0;
            border-top-right-radius: 0
        }

        .select2-container--classic.select2-container--open.select2-container--below .select2-selection--multiple {
            border-bottom: none;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0
        }

        .select2-container--classic .select2-search--dropdown .select2-search__field {
            border: 1px solid #aaa;
            outline: 0
        }

        .select2-container--classic .select2-search--inline .select2-search__field {
            outline: 0;
            box-shadow: none
        }

        .select2-container--classic .select2-dropdown {
            background-color: #fff;
            border: 1px solid transparent
        }

        .select2-container--classic .select2-dropdown--above {
            border-bottom: none
        }

        .select2-container--classic .select2-dropdown--below {
            border-top: none
        }

        .select2-container--classic .select2-results > .select2-results__options {
            max-height: 200px;
            overflow-y: auto
        }

        .select2-container--classic .select2-results__option--group {
            padding: 0
        }

        .select2-container--classic .select2-results__option--disabled {
            color: grey
        }

        .select2-container--classic .select2-results__option--highlighted.select2-results__option--selectable {
            background-color: #3875d7;
            color: #fff
        }

        .select2-container--classic .select2-results__group {
            cursor: default;
            display: block;
            padding: 6px
        }

        .select2-container--classic.select2-container--open .select2-dropdown {
            border-color: #5897fb
        }

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
            Margin-bottom: -4px; }

        .select2-container {
            width: 100% !important; }
        .select2-container.select2-container--open .select2-selection--single .select2-selection__arrow b {
            -ms-transform: rotate(180deg);
            transform: rotate(180deg); }

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

        .select2-container--default .select2-results__option--selected {
            background-color: #41445b70; }



        [class~=select2-container] .select2-selection--single {
            padding: 0;
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
        .select2-container[class~=select2-container] {
            margin-top: 1px;
        }
        .select2-selection__clear {
            color: white !important;
            top: 0 !important;
        }

        .select2-container--krajee-bs3 .select2-results__option[aria-selected]{
            background-color: #10131bd9;
            color: #fff;
        }

        .select2-container--default .select2-results__option[aria-selected=true],
        .select2-container--krajee-bs3 .select2-results__option[aria-selected=true],
        .select2-container--krajee-bs3 li.select2-results__option{
            background-color: #41445b70;
            color: #fff;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected],
        .select2-container--krajee-bs3 .select2-results__option--highlighted[aria-selected] {
            background-color: #41445b70;
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