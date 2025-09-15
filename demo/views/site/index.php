<?php

use app\models\TestModel;
use kak\widgets\select2\Select2;
use yii\widgets\ActiveForm;

/**
 * @var TestModel $model
 **/

?>


<?php $form = ActiveForm::begin() ?>

   <div class="row">
       <div class="col-md-4">
           <?=$form->field($model, 'countryId')->widget(Select2::class, []) ?>
           <?=$form->field($model, 'cityId')->widget(Select2::class, []) ?>
       </div>
   </div>

<?php ActiveForm::end() ?>