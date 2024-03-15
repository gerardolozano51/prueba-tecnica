<?php

use yii\db\Migration;

/**
 * Class m240314_225521_users
 */
class m240314_225521_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m240314_225521_users cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'username' => $this->string()->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'authKey' => $this->string(),
            'telefono' => $this->string(),
            'accessToken' => $this->string(),
            'rol' => $this->string(),
        ]);


        $this->insert('{{%user}}', [
            'name' => 'Administrador',
            'username' => 'admin@admin.com',
            'password' => sha1('admin123'),
            'telefono' => '1234567890',
            'authKey' => \Yii::$app->security->generateRandomString(),
            'accessToken' => \Yii::$app->security->generateRandomString(),
            'rol' => 'admin',
        ]);
    }
    /*
    public function down()
    {
        echo "m240314_225521_users cannot be reverted.\n";

        return false;
    }
    */
}
