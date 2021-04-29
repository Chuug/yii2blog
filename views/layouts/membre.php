<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Url;
use yii\helpers\Html;
use app\widgets\Alert;
use app\assets\AppAsset;
use yii\bootstrap4\ActiveForm;
use yii\widgets\Breadcrumbs;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
   <meta charset="<?= Yii::$app->charset ?>">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <?php $this->registerCsrfMetaTags() ?>
   <title><?= Html::encode(Yii::$app->name.' - '.$this->title) ?></title>
   <?php $this->head() ?>
   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
   <nav class="navbar navbar-dark bg-dark navbar-expand-lg fixed-top">
      <div class="container">
         <a class="navbar-brand" href="<?= Url::home() ?>"><?= Yii::$app->name ?></a>
         <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-auto">
               <li class="nav-item active">
                  <a class="nav-link" href="<?= Url::home() ?>">Accueil</a>
               </li>
               <?php if(Yii::$app->user->isGuest): ?>
                  <li class="nav-item">
                     <a href="<?= Url::toRoute('user/login') ?>" class="nav-link">Connexion</a>
                  </li>
                  <li class="nav-item">
                     <a href="<?= Url::toRoute('user/signup') ?>" class="nav-link">S'enregistrer</a>
                  </li>
               <?php else: ?>
                  <li class="nav-item">
                     <a href="<?= Url::toRoute('user/membre') ?>" class="nav-link">Espace membre</a>
                  </li>
                  <li class="nav-item">
                     <?php ActiveForm::begin(['action' => ['user/logout']]) ?>
                        <button type="submit" class="btn btn-link nav-link">Déconnexion (<?= Yii::$app->user->identity->username ?>)</button>
                     <?php ActiveForm::end() ?>
                  </li>
               <?php endif; ?>
            </ul>
         </div>      
      </div>
   </nav>
   <div class="container">
      <h3><?= $this->title ?></h3>
      <div class="row">
         <div class="col-3 bg-white shadow-sm p-3">
               <a href="<?= Url::toRoute('user/membre') ?>" class="btn btn-block <?= (Yii::$app->controller->action->id == 'membre')?'btn-dark':'btn-secondary' ?>">Profil</a>
               <a href="<?= Url::toRoute('blog/index') ?>" class="btn btn-block <?= (Yii::$app->controller->id == 'blog' && Yii::$app->controller->action->id != 'admin')?'btn-dark':'btn-secondary' ?>">Mes articles</a>
            <?php if(Yii::$app->authManager->checkAccess(Yii::$app->user->id, 'admin')): ?>
               <h4 class="py-3">Admin</h4>
               <a href="<?= Url::toRoute('user/admin') ?>" class="btn btn-block btn-<?= (Yii::$app->controller->action->id == 'admin' && Yii::$app->controller->id == 'user') ? 'dark' : 'secondary' ?>">Utilisateurs</a>
               <a href="<?= Url::toRoute('blog/admin') ?>" class="btn btn-block btn-<?= (Yii::$app->controller->action->id == 'admin' && Yii::$app->controller->id == 'blog') ? 'dark' : 'secondary' ?>">Articles</a>
            <?php endif; ?>
         </div>
         <div class="col bg-white shadow-sm ml-3 p-3">
            <?= $content ?>
         </div>
      </div>
   </div>
</div>

<footer class="footer">
   <div class="container">
      <p class="pull-left">&copy; Yii2Blog <?= date('Y') ?></p>

      <p class="pull-right"><?= Yii::powered() ?></p>
   </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
