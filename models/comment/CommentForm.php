<?php

namespace app\models\comment;

use Yii;
use yii\base\Model;
use yii\db\Expression;
use app\models\Comment;

class CommentForm extends Model
{
   public $body;

   public function rules()
   {
      return [
         [
            ['body'], 'required',
            'message' => 'Ce champs est requis'
         ]
      ];
   }

   public function create($blogId)
   {
      $comment = new Comment();
      $comment->user_id = Yii::$app->user->id;
      $comment->blog_id = $blogId;
      $comment->body = $this->body;
      $comment->created_at = new Expression('NOW()');
      return $comment->save();
   }
}