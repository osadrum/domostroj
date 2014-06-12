<?php

class m140416_075510_create_table_role extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{roles}}', array(
            'id' => 'int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'name' => 'varchar(50) NOT NULL',
            'title' => 'varchar(50) NOT NULL'
        ));

        $this->insert('{{roles}}', array(
            'name' => 'admin',
            'title' => 'Администратор'
        ));

        $this->insert('{{roles}}', array(
            'name' => 'user',
            'title' => 'Пользователь'
        ));
    }

    public function down()
    {
        $this->dropTable('{{roles}}');
    }

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}