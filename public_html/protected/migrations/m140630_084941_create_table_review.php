<?php

class m140630_084941_create_table_review extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{review}}',array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) NOT NULL',
            'description' => 'text',
            'image' => 'varchar(127)',
            'document' => 'varchar(127)',
            'is_published' => "tinyint(1) unsigned NOT NULL DEFAULT '1'",
        ));
	}

	public function down()
	{
		$this->dropTable('{{review}}');
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