<?php

use yii\db\Migration;

/**
 * Class m180920_144535_uni_token
 */
class m180920_144535_uni_token extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('link' , 'token' , $this->string(10)->unique());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180920_144535_uni_token cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180920_144535_uni_token cannot be reverted.\n";

        return false;
    }
    */
}
