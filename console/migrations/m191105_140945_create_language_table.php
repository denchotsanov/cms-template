<?php

use common\models\Language;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%language}}`.
 */
class m191105_140945_create_language_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%language}}', [
            'id' => $this->primaryKey(),
            'code' => $this->char(2)->notNull()->unique(),
            'name' =>$this->string(15)->notNull(),
            'flag' => $this->string(6)->notNull(),
            'status'=> $this->integer()->notNull()->defaultValue(Language::STATUS_ACTIVE),
            'created_at'=> $this->integer()->notNull(),
            'updated_at'=> $this->integer()->notNull(),
        ]);

        $language = new Language();

        $language->code = 'en';
        $language->name = 'English';
        $language->flag = 'gb-eng';
        $language->status = Language::STATUS_ACTIVE;
        $language->save();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%language}}');
    }
}
