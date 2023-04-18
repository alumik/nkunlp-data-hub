<?php

use yii\db\Migration;

/**
 * Class m230417_090441_add_drives
 */
class m230417_090441_add_drives extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        for ($i = 1; $i <= 100; $i++) {
            $this->insert('drive', [
                'name' => 'NKU-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'updated_at' => time(),
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('drive');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m230417_090441_add_drives cannot be reverted.\n";

        return false;
    }
    */
}
