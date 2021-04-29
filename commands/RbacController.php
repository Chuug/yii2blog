<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
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

      $rule = new \app\rbac\AuthorRule;
      $auth->add($rule);

      $ownArticle = $auth->createPermission('ownArticle');
      $ownArticle->description = "Mettre à jour ses propres articles";
      $ownArticle->ruleName = $rule->name;
      $auth->add($ownArticle);

      $auth->addChild($ownArticle, $updateArticle);
      $auth->addChild($author, $ownArticle);
   }
}