<?php

use yii\db\Schema;
use yii\db\Migration;

class m150312_172156_meta_tags extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%meta_tags}}', [
            'id' => Schema::TYPE_PK,
            'model' => Schema::TYPE_STRING . ' NOT NULL',
            'model_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'keywords' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
            'time_update' => Schema::TYPE_INTEGER . ' NOT NULL DEFAULT 0',
        ]);

        $this->createIndex('object', '{{%meta_tags}}', ['model', 'model_id'], true);
    }
    
    public function safeDown()
    {
        $this->dropTable('{{%meta_tags}}');
    }
}
