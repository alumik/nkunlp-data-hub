<?php

use yii\db\Migration;

/**
 * Class m230417_093952_add_modifiers
 */
class m230417_093952_add_modifiers extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-cc_chinese_extraction-id_cc_download',
            'cc_chinese_extraction',
            'id_cc_download',
            true
        );

        $this->createIndex(
            'idx-cc_deduplication-id_cc_filtering',
            'cc_deduplication',
            'id_cc_filtering',
            true
        );

        $this->createIndex(
            'idx-cc_download-id_cc_data',
            'cc_download',
            'id_cc_data',
            true
        );

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

        $this->createIndex(
            'idx-cc_filtering_filter-id_cc_filtering-id_cc_filter',
            'cc_filtering_filter',
            ['id_cc_filtering', 'id_cc_filter'],
            true
        );

        $this->createIndex(
            'idx-drive-name',
            'drive',
            'name',
            true
        );

        $this->createIndex(
            'idx-year_month-cc_code',
            'year_month',
            'cc_code',
            true
        );

        $this->createIndex(
            'idx-year_month-year-month',
            'year_month',
            ['year', 'month'],
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230417_093952_add_modifiers cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230417_093952_add_modifiers cannot be reverted.\n";

        return false;
    }
    */
}
