<?php
namespace app\rbac;

use Yii;
use yii\rbac\Rule;

class AuthorRule extends Rule
{
   public $name;

   public function __construct($name)
   {
      $this->name = $name;
   }

   public function execute($user, $item, $params)
   {
      return ($params['target']) ? $params['target']->user_id == $user || Yii::$app->authManager->checkAccess(Yii::$app->user->id, 'admin') : false;
   }
}