<?php
namespace app\models\user;

use Yii;
use yii\base\Model;
use app\models\User;

class SignupForm extends Model
{
   public $username;
   public $email;
   public $password;
   public $password_repeat;

   public function rules()
   {
      return [
         [
            ['username','password','password_repeat','email'], 'required',
            'message' => 'Ce champs est requis'
         ],
         [
            ['email'], 'email',
            'message' => "Cet email n'est pas valide",
         ],
         [
            ['email'], 'unique',
            'targetClass' => User::class,
            'message' => "Cet email est déjà utilisé",
         ],
         [
            ['username'], 'unique',
            'targetClass' => User::class,
            'message' => "Ce nom d'utilisateur est déjà utilisé"
         ],
         [
            ['password'], 'compare',
            'message' => "Les mots de passe ne sont pas identiques"
         ]
         ];
   }

   public function signup()
   {
      if ($this->validate()) {
         $user = new User();
         $user->username = $this->username;
         $user->email = $this->email;
         $user->hashPassword($this->password);
         $user->save(false);
         
         $auth = Yii::$app->authManager;
         $authorRole = $auth->getRole('auteur');
         $auth->assign($authorRole, $user->getId());

         return $user;
      }
   }
}