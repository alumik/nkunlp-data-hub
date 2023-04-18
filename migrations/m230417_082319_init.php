<?php

use yii\db\Migration;

/**
 * Class m230417_082319_init
 */
class m230417_082319_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('year_month', [
            'id' => $this->primaryKey(),
            'year' => $this->string()->notNull(),
            'month' => $this->string()->notNull(),
            'cc_code' => $this->string()->notNull(),
        ]);

        $this->insert('year_month', [
            'id' => 1,
            'year' => 'N/A',
            'month' => 'N/A',
            'cc_code' => 'N/A',
        ]);

        $this->createTable('cc_data', [
            'id' => $this->primaryKey(),
            'uri' => $this->string(1023)->notNull(),
            'id_year_month' => $this->integer()->notNull()->defaultValue(1),
        ]);

        $this->createTable('drive', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'location' => $this->string(),
            'description' => $this->string(),
            'updated_at' => $this->integer(),
        ]);

        $this->createTable('cc_storage', [
            'id' => $this->primaryKey(),
            'id_drive' => $this->integer()->notNull(),
            'id_year_month' => $this->integer()->notNull()->defaultValue(1),
            'prefix' => $this->string()->notNull(),
            'path' => $this->string(1023)->notNull(),
            'size' => $this->integer(),
        ]);

        $this->createTable('cc_download', [
            'id' => $this->primaryKey(),
            'id_cc_data' => $this->integer()->notNull(),
            'id_storage' => $this->integer(),
            'started_at' => $this->integer(),
            'finished_at' => $this->integer(),
        ]);

        $this->createTable('cc_chinese_extraction', [
            'id' => $this->primaryKey(),
            'id_cc_download' => $this->integer()->notNull(),
            'id_storage' => $this->integer(),
            'started_at' => $this->integer(),
            'finished_at' => $this->integer(),
        ]);

        $this->createTable('cc_filter', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'parameters' => $this->string(),
        ]);

        $this->createTable('cc_filtering', [
            'id' => $this->primaryKey(),
            'id_cc_chinese_extraction' => $this->integer()->notNull(),
            'id_storage' => $this->integer(),
            'started_at' => $this->integer(),
            'finished_at' => $this->integer(),
        ]);

        $this->createTable('cc_filtering_filter', [
            'id' => $this->primaryKey(),
            'id_cc_filtering' => $this->integer()->notNull(),
            'id_cc_filter' => $this->integer()->notNull(),
        ]);

        $this->createTable('cc_deduplication', [
            'id' => $this->primaryKey(),
            'id_cc_filtering' => $this->integer()->notNull(),
            'id_storage' => $this->integer(),
            'started_at' => $this->integer(),
            'finished_at' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-cc_data-id_year_month',
            'cc_data',
            'id_year_month',
            'year_month',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cc_storage-id_drive',
            'cc_storage',
            'id_drive',
            'drive',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cc_storage-id_year_month',
            'cc_storage',
            'id_year_month',
            'year_month',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cc_download-id_cc_data',
            'cc_download',
            'id_cc_data',
            'cc_data',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cc_download-id_storage',
            'cc_download',
            'id_storage',
            'cc_storage',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cc_chinese_extraction-id_cc_download',
            'cc_chinese_extraction',
            'id_cc_download',
            'cc_download',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cc_chinese_extraction-id_storage',
            'cc_chinese_extraction',
            'id_storage',
            'cc_storage',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cc_filtering-id_cc_chinese_extraction',
            'cc_filtering',
            'id_cc_chinese_extraction',
            'cc_chinese_extraction',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-cc_filtering-id_storage',
            'cc_filtering',
            'id_storage',
            'cc_storage',
            'id',
            'CASCADE'
        );

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

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m230417_082319_init cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230417_082319_init cannot be reverted.\n";

        return false;
    }
    */
}
