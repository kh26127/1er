<?php

use yii\db\Migration;

/**
 * Class m180918_204925_link
 */
class m180918_204925_link extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%link}}' , [
            'id' => $this->primaryKey(),
            'url' => $this->string(4000),
            'token' => $this->string(10),
            'click' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180918_204925_link cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180918_204925_link cannot be reverted.\n";

        return false;
    }
    */
}
