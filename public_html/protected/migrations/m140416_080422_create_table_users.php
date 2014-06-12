<?php

class m140416_080422_create_table_users extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{users}}', array(
            'id' => 'int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            '_role' => 'int(4) NOT NULL',
            'name' => 'varchar(127) NOT NULL',
            'login' => 'varchar(100) NOT NULL',
            'password' => 'varchar(100) NOT NULL',
            'email' => 'varchar(100)',
            'phone' => 'varchar(15)',
            'last_activity' => 'datetime',
            'last_visit' => 'datetime',
        ));

        $this->addForeignKey('FK-user-role','{{users}}', '_role', '{{roles}}', 'id');

        $this->insert('{{users}}', array(
            '_role' => 1,
            'name' => 'Администратор',
            'login' => 'admin',
            'password' => '56Xh0RAeByXi.',
            'email' => '',
            'phone' => '',
            'last_activity' => 'datetime',
            'last_visit' => 'datetime',
        ));
	}

	public function down()
	{
		$this->dropTable('{{users}}');
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