<?php

use yii\db\Schema;
use yii\db\Migration;

class m151118_184749_intialize extends Migration
{
    public function up()
    {
        $this->createTable('keyword', [
            'keyword' => Schema::TYPE_STRING ." PRIMARY KEY",
            'urls' =>  "MEDIUMTEXT"
        ]);

        return true;
    }

    public function down()
    {
        $this->dropTable('keyword');

        return true;
    }
}
