<?php

namespace app\models\blog;

use Yii;
use yii\base\Model;
use app\models\Blog;
use yii\db\Expression;

class BlogForm extends Model
{
   public $title;
   public $body;
   public $published;

   public function __construct($article = null)
   {
      if ($article) {
         $this->title = $article->title;
         $this->body = $article->body;
         $this->published = $article->published;
      }
   }

   public function rules()
   {
      return [
         [
            ['title','body'], 'required',
            'message' => 'Ce champs est requis'
         ],
         [
            ['title'], 'string',
            'min' => 3,
            'max' => 100
         ]
      ];
   }

   public function create()
   {
      $article = new Blog();
      $article->user_id = Yii::$app->user->id;
      $article->title = $this->title;
      $article->body = $this->body;
      $article->created_at = new Expression('NOW()');
      return $article->save();
   }

   public function update($article)
   {
      $article->title = $this->title;
      $article->body = $this->body;
      $article->published = $this->published;
      $article->updated_at = new Expression('NOW()');
      return $article->save();
   }
}
