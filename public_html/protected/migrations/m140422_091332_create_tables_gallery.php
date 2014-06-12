<?php

class m140422_091332_create_tables_gallery extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{gallery_category}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'is_published' => "tinyint(1) unsigned NOT NULL DEFAULT '1'",
            'title' => 'varchar(255) NOT NULL',
            'description' => 'text',
            'image' => 'varchar(127)',
            'meta_description' => 'varchar(255) NOT NULL',
            'meta_keywords' => 'varchar(255) NOT NULL',
            'root' => 'int(10)',
            'lft' => 'int(10)',
            'rgt' => 'int(10)',
            'level' => 'int(10)',
            '_parent' => 'int(10)',
        ));

        $this->createTable('{{gallery_images}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'is_published' => "tinyint(1) unsigned NOT NULL DEFAULT '1'",
            'title' => 'varchar(255)',
            'image' => 'varchar(127)',
            '_category' => 'int(10)',
        ));

        $this->addForeignKey('FK-images-category','{{gallery_images}}', '_category', '{{gallery_category}}', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('FK-images-category','{{gallery_images}}');
        $this->dropTable('{{gallery_images}}');
        $this->dropTable('{{gallery_category}}');
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