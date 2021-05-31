<?php

use yii\helpers\Url;
use yii\bootstrap4\ActiveForm;

$this->title = $article->title;

?>
<div class="container">
   <div class="row">
      <div class="col bg-white shadow-sm p-3">
            <span class="h3 font-weight-normal"><?= $article->title ?></span> par <span class="font-italic"><?= $article->user->username ?></span> <span class="float-right"><?= $article->created_at ?></span>
            <hr>
            <p class="mb-0 mt-3"><?= $article->body ?></p>
      </div>
   </div>
   <h4 class="font-weight-light mt-3"><?= count($article->comments) ?> commentaire<?= (count($article->comments) > 1)?'s':'' ?></h4>
   <hr class="mb-4">  
      <?php foreach($article->comments as $comment): ?>
         <div class="row mb-4">
            <div class="col shadow-sm bg-white rounded-sm p-3">
               <div class="row">
                  <div class="col-auto">
                     <img src="<?= Url::to('@web/img/default-avatar.png') ?>" alt="Avatar de <?= $comment->user->username ?>"  width="45" class="avatar-sized rounded-circle shadow-sm">
                  </div>
                  <div class="col ps-0">
                     <span class="d-block fw-bold"><?= $comment->user->username ?></span>
                     <span class="small fw-light"><?= $comment->created_at ?></span>
                  </div>
                  <div class="col text-right">
                     <?php if(Yii::$app->user->can('ownArticle', ['target' => $comment])): ?>
                        <div class="drop-menu">
                           <button class="btn btn-sm btn-outline-dark drop-btn">
                              <i class="fas fa-chevron-down drop-btn-icon"></i>
                           </button>
                           <div class="drop-me">
                              <ul class="drop">
                                    <li><a href="<?= Url::toRoute(['blog/delete-comment', 'id' => $comment->id]) ?>">Supprimer</a></li>
                              </ul>
                           </div>
                        </div>
                     <?php endif; ?>
                  </div>
               </div>
               <hr>
               <div class="row px-3">
                  <?= $comment->body ?>
               </div>
            </div>
         </div>    
      <?php endforeach; ?>
  
   <div class="row mt-3">
         <div class="col">
         <?php if(\Yii::$app->user->can('createComment')): ?>
            <?php $form = ActiveForm::begin(); ?>
               <?= $form->field($commentForm, 'body')->textarea()->label("Envoyer un commentaire") ?>
               <button type="submit" class="btn btn-dark float-right">Envoyer</button>
            <?php ActiveForm::end(); ?>
         <?php endif; ?>     
         </div>
      </div>
</div>
