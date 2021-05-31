<?php

namespace app\models;

use Yii;
use app\models\Blog;
use yii\db\ActiveRecord;
use yii\helpers\VarDumper;
use yii\web\IdentityInterface;


class User extends ActiveRecord implements IdentityInterface
{
   public static function tableName()
   {
      return 'user';
   }

   public function getArticles()
   {
      return $this->hasMany(Blog::class, ['user_id' => 'id']);
   }

   public function getComments()
   {
      return $this->hasMany(Comment::class, ['user_id' => 'id']);
   }

   public function hashPassword($password)
   {
      $this->password_hash = Yii::$app->security->generatePasswordHash($password);
   }

   public static function findIdentity($id)
   {
      return self::findOne($id);
   }

   public static function findIdentityByAccessToken($token, $type = null)
   {
      return self::findOne(['accessToken' => $token]);
   }

   public static function findByUsername($username)
   {
      return self::findOne(['username' => $username]);
   }

   public function getId()
   {
      return $this->getPrimaryKey();
   }

   public function getAuthKey()
   {
      return $this->auth_key;
   }

   public function validateAuthKey($authKey)
   {
      return $this->getAuthKey() === $authKey;
   }

   public function validatePassword($password)
   {
      return Yii::$app->security->validatePassword($password, $this->password_hash);
   }
}
