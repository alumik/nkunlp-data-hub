<?php

use yii\db\Migration;

/**
 * Class m230418_023322_add_status_column
 */
class m230418_023322_add_status_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('cc_download', 'status', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('cc_chinese_extraction', 'status', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('cc_filtering', 'status', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('cc_deduplication', 'status', $this->integer()->notNull()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('cc_download', 'status');
        $this->dropColumn('cc_chinese_extraction', 'status');
        $this->dropColumn('cc_filtering', 'status');
        $this->dropColumn('cc_deduplication', 'status');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230418_023322_add_status_column cannot be reverted.\n";

        return false;
    }
    */
}
