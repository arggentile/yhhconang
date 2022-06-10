<?php

use yii\db\Migration;

/**
 * Class m220608_124247_insertarDataInicial
 */
class m220608_124247_insertarDataInicial extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $query = file_get_contents(dirname(__FILE__) . '/' . get_class($this) . ".sql");
        $this->db->pdo->exec($query);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m220608_124247_insertarDataInicial cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m220608_124247_insertarDataInicial cannot be reverted.\n";

        return false;
    }
    */
}
