<?php

use yii\db\Migration;

/**
 * Handles the creation of table `profile`.
 */
class m190321_191413_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'name' => $this->string(),
        ]);

        $this->addForeignKey(
            'profile_related_user',
            '{{%profile}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
            );
        $this->createIndex('index_user_id','{{%profile}}','user_id',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('index_user_id','{{%profile}}');
        $this->dropForeignKey('profile_related_user','{{%profile}}');
        $this->dropTable('{{%profile}}');
    }
}
