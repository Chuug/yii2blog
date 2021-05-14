<?php

/* @var $this yii\web\View */

$this->title = 'Home';
?>
<div class="container">
   <?php foreach($articles as $article): ?>
   <div class="row">
      <div class="col-7 pl-0">
            <a href="#" class="text-decoration-none"><h2 class="page-title"><?= $article->title ?></h1></a>
      </div>
      <div class="col-5 text-muted text-right mt-4 pr-0">
            <small>Par <span class="text-body"><?= $article->user->username ?></span>, le <?= $article->created_at ?></small>
      </div>
   </div>
   
   <div class="row">
      <div class="col shadow-sm bg-white p-3 rounded-sm">
            <?= $article->body ?>
      </div>
   </div>
   <div class="row text-right">
      <div class="col pr-0 mt-2 px-0">
      <a href="#" class="text-muted mr-2 text-muted font-italic"><u>?? commentaire(s)</u></a>
      <?php if(Yii::$app->user->can('ownArticle', ['article' => $article])): ?>
         <a href="#" class="btn btn-sm btn-dark"><i class="fas fa-sm fa-edit me-1"></i> Editer</a>
      <?php endif;?>

      </div>
   </div> 
   <?php endforeach; ?>
</div>
