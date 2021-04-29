<?php

use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;
$this->title = "Nouvel article";
?>
<a href="<?= Url::toRoute('blog/index') ?>" class="btn btn-dark mb-2">Retour</a>
<?php $form = ActiveForm::begin(); ?>
   <?= $form->field($createForm, 'title')->textInput(['autofocus' => true]) ?>
   <?= $form->field($createForm, 'body')->textarea() ?>
   <button class="btn btn-dark btn-block" type="submit">Créer l'article</button>
<?php ActiveForm::end(); ?>