<?php

namespace app\models\user;

use Yii;
use yii\base\Model;
use app\models\User;

class LoginForm extends Model
{
   public $username;
   public $password;
   public $rememberMe = true;

   private $_user;

   public function rules()
   {
      return [
         [
            ['username', 'password'], 'required',
            'message' => 'Ce champs est requis'
         ],
         [
            'password', 'validatePassword'
         ]
      ];
   }

   public function validatePassword($attribute, $params)
   {
      if(!$this->hasErrors()) {
         $user = $this->getUser();
         if(!$user || !$user->validatePassword($this->password)) {
            $this->addError($attribute, "Le mot de passe ou le nom d'utilisateur est incorrect");
         }
      }
   }

   public function login()
   {
      if($this->validate()) {
         return Yii::$app->user->login($this->getUser());
      }
      return false;
   }

   protected function getUser()
   {
      if($this->_user === null) {
         $this->_user = User::findByUsername($this->username);
      }
      return $this->_user;
   }
}
