<?php

use yii\bootstrap4\ActiveForm;

$this->title = "Editer article";
?>

<?php $form = ActiveForm::begin(); ?>
   <?= $form->field($updateForm, 'title')->textInput() ?>
   <?= $form->field($updateForm, 'body')->textarea() ?>
   <?= $form->field($updateForm, 'published')->dropdownList([0 => "Non publié", 1 => "Publié"])->label(false) ?>
   <button class="btn btn-dark btn-block" type="submit">Sauvegarder les modifications</button>
<?php ActiveForm::end(); ?>