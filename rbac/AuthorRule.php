<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class AuthorRule extends Rule
{
   public $name = 'isAuthor';

   public function execute($user, $item, $params)
   {
      return ($params['article']) ? $params['article']->user_id == $user || Yii::$app->authManager->checkAccess(Yii::$app->user->id, 'admin') : false;
   }
}