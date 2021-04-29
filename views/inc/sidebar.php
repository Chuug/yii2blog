<?php 
use yii\helpers\Url;
?>
<div class="col-3 bg-white shadow-sm p-3">
      <a href="<?= Url::toRoute('user/membre') ?>" class="btn btn-block <?= (Yii::$app->controller->action->id == 'membre')?'btn-dark':'btn-secondary' ?>">Profil</a>
      <a href="<?= Url::toRoute('blog/index') ?>" class="btn btn-block <?= (Yii::$app->controller->action->id == 'index')?'btn-dark':'btn-secondary' ?>">Mes articles</a>
</div>