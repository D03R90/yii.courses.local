<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m190525_084651_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'username' => $this->string( 255 )->notNull(),
            'name' => $this->string( 255 )->notNull(),
            'surname' => $this->string( 255 ),
            'deadline' => $this->date(),
            'status_id' => $this->integer()
        ]);

        $this->createIndex("users_creator_idx", 'users', ['creator_id']);
        $this->createIndex("users_name", 'users', ['name']);
        $this->createIndex("users_deadline", 'users', ['deadline']);
        $this->createIndex("status_idx", 'users', ['status_id']);
   }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');
    }

}
