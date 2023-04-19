<?php

use yii\db\Migration;

/**
 * Class m230418_182035_add_uri_and_path_idx
 */
class m230418_182035_add_uri_and_path_idx extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx_cc_data_uri',
            'cc_data',
            'uri',
            true,
        );
        $this->createIndex(
            'idx_cc_storage_prefix_path',
            'cc_storage',
            ['prefix', 'path'],
            true,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx_cc_data_uri', 'cc_data');
        $this->dropIndex('idx_cc_storage_prefix_path', 'cc_storage');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230418_182035_add_uri_and_path_idx cannot be reverted.\n";

        return false;
    }
    */
}
