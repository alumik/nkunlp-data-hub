<?php

use yii\db\Migration;

/**
 * Class m230421_033453_drop_table_cc_filtering_filter_and_cc_deduplication
 */
class m230421_033453_drop_table_cc_filtering_filter_and_cc_deduplication extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropTable('cc_filtering_filter');
        $this->dropTable('cc_deduplication');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->createTable('cc_filtering_filter', [
            'id' => $this->primaryKey(),
            'id_cc_filtering' => $this->integer()->notNull(),
            'id_cc_filter' => $this->integer()->notNull(),
        ]);
        $this->createTable('cc_deduplication', [
            'id' => $this->primaryKey(),
            'id_cc_filtering' => $this->integer()->notNull()->unique(),
            'id_storage' => $this->integer(),
            'started_at' => $this->integer(),
            'finished_at' => $this->integer(),
            'status' => $this->integer()->notNull()->defaultValue(0),
        ]);
        $this->addForeignKey(
            'fk-cc_deduplication-id_cc_filtering',
            'cc_deduplication',
            'id_cc_filtering',
            'cc_filtering',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cc_deduplication-id_storage',
            'cc_deduplication',
            'id_storage',
            'cc_storage',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-cc_filtering_filter-id_cc_filtering',
            'cc_filtering_filter',
            'id_cc_filtering',
            'cc_filtering',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cc_filtering_filter-id_cc_filter',
            'cc_filtering_filter',
            'id_cc_filter',
            'cc_filter',
            'id',
            'CASCADE'
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230421_033453_drop_table_cc_filtering_filter_and_cc_deduplication cannot be reverted.\n";

        return false;
    }
    */
}
