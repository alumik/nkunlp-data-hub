<?php

use yii\db\Migration;

/**
 * Class m230421_021914_update_cc_filter_index
 */
class m230421_021914_update_cc_filter_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('idx-cc_filter-name', 'cc_filter');
        $this->dropForeignKey('fk-cc_filtering-id_cc_chinese_extraction', 'cc_filtering');
        $this->dropIndex('idx-cc_filtering-id_cc_chinese_extraction', 'cc_filtering');
        $this->createIndex(
            'idx-cc_filter-name-parameters',
            'cc_filter',
            ['name', 'parameters'],
            true
        );
        $this->addForeignKey(
            'fk-cc_filtering-id_cc_chinese_extraction',
            'cc_filtering',
            'id_cc_chinese_extraction',
            'cc_chinese_extraction',
            'id',
            'CASCADE',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-cc_filter-name-parameters', 'cc_filter');
        $this->createIndex(
            'idx-cc_filter-name',
            'cc_filter',
            'name',
            true
        );
        $this->createIndex(
            'idx-cc_filtering-id_cc_chinese_extraction',
            'cc_filtering',
            'id_cc_chinese_extraction',
            true
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230421_021914_update_cc_filter_index cannot be reverted.\n";

        return false;
    }
    */
}
