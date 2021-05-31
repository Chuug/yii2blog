<?php
namespace app\models;

use yii\base\Model;
use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{
   public static function tableName()
   {
      return 'comment';
   }

   public function getUser()
   {
      return $this->hasOne(User::class, ['id' => 'user_id']);
   }

   public function getArticle()
   {
      return $this->hasOne(Blog::class, ['id' => 'blog_id']);
   }

   public static function get($id)
   {
      return Comment::find()->where(['id' => $id])->one();
   }

   public static function destroy($id)
   {
      return Comment::find()->where(['id' => $id])->one()->delete();
   }
}