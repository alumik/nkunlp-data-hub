<?php

use yii\db\Migration;

/**
 * Class m230418_143709_add_size_column_to_table_cc_download
 */
class m230418_143709_add_size_column_to_table_cc_download extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cc_download', 'size', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('cc_download', 'size');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230418_143709_add_size_column_to_table_cc_download cannot be reverted.\n";

        return false;
    }
    */
}
