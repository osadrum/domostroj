<?php

class m140418_082824_create_page extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{pages}}', array(
            'id' => 'pk',
            'root' => 'int(10)',
            'lft' => 'int(10)',
            'rgt' => 'int(10)',
            'level' => 'int(10)',
            'parent_id' => "int(10)",
            'slug' => 'varchar(255) NOT NULL',
            'layout' => 'varchar(255) NOT NULL',
            'is_published' => 'int(10)',
            'page_title' => 'varchar(255) NOT NULL',
            'content' => 'text NOT NULL',
            'meta_title' => 'varchar(255)',
            'meta_description' => 'varchar(255)',
            'meta_keywords' => 'varchar(255)',
            'sort' => 'int(4)',
            'is_showed_menu' => 'tinyint(1)'
        ));
	}

	public function down()
	{
		$this->droptable('{{pages}}');
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