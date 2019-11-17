<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%profile}}`.
 */
class m191117_154555_add_language_column_to_profile_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%profile}}', 'language', $this->string(6)->defaultValue('en'));
    }

    public function down()
    {
        $this->dropColumn('{{%profile}}', 'language');
    }
}
