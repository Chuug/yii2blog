<?php
use yii\db\Migration;

/**
 * Class m210514_120959_database
   */
class m210514_120959_database extends Migration
{
   /**
    * {@inheritdoc}
    */
   public function safeUp()
   {
      $this->createTable('user', [
         'id' => $this->primaryKey(),
         'username' => $this->char(30),
         'email' => $this->char(255),
         'password_hash' => $this->char(255),
         'auth_key' => $this->char(255)
      ]);

      $this->insert('user', [
         'username' => 'admin',
         'email' => 'admin@admin.com',
         'password_hash' => Yii::$app->security->generatePasswordHash('admin')
      ]);

      $auth = Yii::$app->authManager;
      $authorRole = $auth->getRole('admin');
      $auth->assign($authorRole, 1);

      $this->createTable('blog', [
         'id' => $this->primaryKey(),
         'user_id' => $this->integer(),
         'title' => $this->char(100),
         'body' => $this->text(),
         'created_at' => $this->timestamp(),
         'updated_at' => $this->timestamp(),
         'published' => $this->boolean(false)
      ]);

      $this->createTable('comment', [
         'id' => $this->primaryKey(),
         'user_id' => $this->integer(),
         'body' => $this->text(),
         'created_at' => $this->timestamp()
      ]);
   }

   /**
    * {@inheritdoc}
    */
   public function safeDown()
   {
      $this->truncateTable('auth_assignment');
      $this->dropTable('user');
      $this->dropTable('blog');
      $this->dropTable('comment');
   }

   /*
   // Use up()/down() to run migration code without a transaction.
   public function up()
   {

   }

   public function down()
   {
      echo "m210514_120959_database cannot be reverted.\n";

      return false;
   }
   */
}
