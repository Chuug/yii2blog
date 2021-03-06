<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Inscription';
?>
<div class="site-login">
   <h1><?= Html::encode($this->title) ?></h1>

   <?php $form = ActiveForm::begin([
      'id' => 'login-form',
      'layout' => 'horizontal',
      'fieldConfig' => [
         'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
         'labelOptions' => ['class' => 'col-lg-1 control-label'],
      ],
   ]); ?>

      <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

      <?= $form->field($model, 'email')->textInput() ?>

      <?= $form->field($model, 'password')->passwordInput() ?>

      <?= $form->field($model, 'password_repeat')->passwordInput() ?>

      <div class="form-group">
         <div class="col-lg-offset-1 col-lg-11">
               <?= Html::submitButton("S'enregistrer", ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
         </div>
      </div>

   <?php ActiveForm::end(); ?>
</div>
