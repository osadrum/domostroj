<?php

class m140627_133200_create_table_slider extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{slider}}',array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) NOT NULL',
            'subtitle' => 'varchar(255) NOT NULL',
            'features' => 'varchar(255) NOT NULL',
            'image' => 'varchar(127)',
            'sort' => 'int(10)',
            'is_published' => "tinyint(1) unsigned NOT NULL DEFAULT '1'",
        ));
	}

	public function down()
	{
        $this->dropTable('{{slider}}');

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