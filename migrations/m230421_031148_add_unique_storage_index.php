<?php

use yii\db\Migration;

/**
 * Class m230421_031148_add_unique_storage_index
 */
class m230421_031148_add_unique_storage_index extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex(
            'idx-cc_download-id_storage',
            'cc_download',
            'id_storage',
            true,
        );
        $this->createIndex(
            'idx-cc_chinese_extraction-id_storage',
            'cc_chinese_extraction',
            'id_storage',
            true,
        );
        $this->createIndex(
            'idx-cc_filtering-id_storage',
            'cc_filtering',
            'id_storage',
            true,
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-cc_download-id_storage', 'cc_download');
        $this->dropForeignKey('fk-cc_chinese_extraction-id_storage', 'cc_chinese_extraction');
        $this->dropForeignKey('fk-cc_filtering-id_storage', 'cc_filtering');
        $this->dropIndex('idx-cc_download-id_storage', 'cc_download');
        $this->dropIndex('idx-cc_chinese_extraction-id_storage', 'cc_chinese_extraction');
        $this->dropIndex('idx-cc_filtering-id_storage', 'cc_filtering');
        $this->addForeignKey(
            'fk-cc_download-id_storage',
            'cc_download',
            'id_storage',
            'cc_storage',
            'id',
            'CASCADE',
        );
        $this->addForeignKey(
            'fk-cc_chinese_extraction-id_storage',
            'cc_chinese_extraction',
            'id_storage',
            'cc_storage',
            'id',
            'CASCADE',
        );
        $this->addForeignKey(
            'fk-cc_filtering-id_storage',
            'cc_filtering',
            'id_storage',
            'cc_storage',
            'id',
            'CASCADE',
        );
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230421_031148_add_unique_storage_index cannot be reverted.\n";

        return false;
    }
    */
}
