<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
   // php yii rbac/init
   public function actionInit()
   {
      $auth = Yii::$app->authManager;

      $createArticle = $auth->createPermission('createArticle');
      $createArticle->description = "Créer un article";
      $auth->add($createArticle);

      $updateArticle = $auth->createPermission('updateArticle');
      $updateArticle->description = "Mettre à jour un article";
      $auth->add($updateArticle);

      $author = $auth->createRole('auteur');
      $auth->add($author);
      $auth->addChild($author, $createArticle);

      $admin = $auth->createRole('admin');
      $auth->add($admin);
      $auth->addChild($admin, $updateArticle);

      $auth->addChild($admin, $author);

      $ruleBlog = new \app\rbac\AuthorRule('articleAuthor');
      $auth->add($ruleBlog);

      $ownArticle = $auth->createPermission('ownArticle');
      $ownArticle->description = "Mettre à jour ses propres articles";
      $ownArticle->ruleName = $ruleBlog->name;
      $auth->add($ownArticle);

      $auth->addChild($ownArticle, $updateArticle);
      $auth->addChild($author, $ownArticle);

      $createComment = $auth->createPermission('createComment');
      $createComment->description = "Ecrire un commentaire";
      $auth->add($createComment);
      
      $auth->addChild($author, $createComment);

      $updateComment = $auth->createPermission('updateComment');
      $updateComment->description = "Editer un commentaire";
      $auth->add($updateComment);

      $auth->addChild($author, $updateComment);

      $ruleComment = new \app\rbac\AuthorRule('commentAuthor');
      $auth->add($ruleComment);

      $ownComment = $auth->createPermission('ownComment');
      $ownComment->description = "Mettre à jour ses propres commentaires";
      $ownComment->ruleName = $ruleComment->name;
      $auth->add($ownComment);

      $auth->addChild($ownComment, $updateComment);
      $auth->addChild($author, $ownComment);
   }

   // php yii rbac/update
   public function actionUpdate()
   {

   }
}