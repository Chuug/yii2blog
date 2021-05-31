<?php
namespace app\models;

use yii\db\ActiveRecord;

class Blog extends ActiveRecord
{
   public static function tableName()
   {
      return 'blog';
   }

   public function getUser()
   {
      return $this->hasOne(User::class, ['id' => 'user_id']);
   }

   public function getComments()
   {
      return $this->hasMany(Comment::class, ['blog_id' => 'id']);
   }

   public static function listAll($userId = null, $order = "DESC")
   {
      return Blog::find()->filterWhere(['user_id' => $userId])->orderBy(['created_at' => ($order == 'DESC') ? SORT_DESC : SORT_ASC])->all();
   }

   public static function publish($id)
   {
      $blog = Blog::find()->where(['id' => $id])->one();
      $blog->published = !$blog->published;
      return $blog->save();
   }

   public static function destroy($id)
   {
      return Blog::find()->where(['id' => $id])->one()->delete();
   }

   public static function get($id)
   {
      return Blog::find()->where(['id' => $id])->one();
   }
}
