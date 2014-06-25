<?php

class m140618_115652_create_tables_for_projects extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{project_category}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) NOT NULL',
            'description' => 'text',
            'meta_title' => 'varchar(255) NOT NULL',
            'meta_description' => 'varchar(255) NOT NULL',
            'meta_keywords' => 'varchar(255) NOT NULL',
            'image' => 'varchar(127)',
            'is_published' => "tinyint(1) unsigned NOT NULL DEFAULT '1'",
            '_parent' => 'int(10)',
        ));

        $this->createTable('{{project}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) NOT NULL',
            'description' => 'text',
            'meta_title' => 'varchar(255) NOT NULL',
            'meta_description' => 'varchar(255) NOT NULL',
            'meta_keywords' => 'varchar(255) NOT NULL',
            'image' => 'varchar(127)',
            'sort' => 'int(10)',
            'is_published' => "tinyint(1) unsigned NOT NULL DEFAULT '1'",
            '_category' => 'int(10)',
        ));

        $this->createTable('{{project_image}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) NOT NULL',
            'image' => 'varchar(127)',
            'sort' => 'int(10)',
            'is_published' => "tinyint(1) unsigned NOT NULL DEFAULT '1'",
            '_project' => 'int(10)',
        ));

        $this->createTable('{{cat_project_option}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) NOT NULL',
        ));

        $this->createTable('{{cat_layout_option}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) NOT NULL',
        ));

        $this->createTable('{{cat_layout_type}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) NOT NULL',
        ));

        $this->insert('{{cat_layout_type}}', array(
            'id' => 1,
            'title' => 'Этаж'
        ));

        $this->createTable('{{cat_construct_type}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) NOT NULL',
        ));

        $this->createTable('{{cat_grade_type}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'title' => 'varchar(255) NOT NULL',
        ));

        $this->createTable('{{cat_construct}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            '_type' => 'int(10) NOT NULL',
            'image' => 'varchar(127)',
            'description' => 'text',
        ));

        $this->createTable('{{project_option}}', array(
            '_project' => 'int(10) NOT NULL',
            '_option' => 'int(10) NOT NULL',
            'value' => 'varchar(255) NOT NULL',
            'PRIMARY KEY (`_project`, `_option`)'
        ));

        $this->createTable('{{layout}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            '_project' => 'int(10) NOT NULL',
            '_type' => 'int(10) NOT NULL',
            'floor' => 'int(10)',
            'image' => 'varchar(127)',
        ));


        $this->createTable('{{layout_option}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            '_layout' => 'int(10) NOT NULL',
            '_option' => 'int(10) NOT NULL',
            'value' => 'varchar(255) NOT NULL',
        ));

        $this->createTable('{{grade}}', array(
            'id' => 'int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            '_project' => 'int(10) NOT NULL',
            '_type' => 'int(10) NOT NULL',
            'price' => 'varchar(255)',
        ));

        $this->createTable('{{grade_construct}}', array(
            '_grade' => 'int(10) NOT NULL',
            '_construct' => 'int(10) NOT NULL',
            'PRIMARY KEY (`_grade`, `_construct`)'
        ));

        $this->addForeignKey('FK-project_category-project_category','{{project_category}}', '_parent', '{{project_category}}', 'id');
        $this->addForeignKey('FK-project-project_category','{{project}}', '_category', '{{project_category}}', 'id');
        $this->addForeignKey('FK-project_image-project','{{project_image}}', '_project', '{{project}}', 'id');
        $this->addForeignKey('FK-project_option-project','{{project_option}}', '_project', '{{project}}', 'id');
        $this->addForeignKey('FK-project_option-cat_project_option','{{project_option}}', '_option', '{{cat_project_option}}', 'id');
        $this->addForeignKey('FK-cat_construct-cat_construct_type','{{cat_construct}}', '_type', '{{cat_construct_type}}', 'id');
        $this->addForeignKey('FK-layout-cat_layout_type','{{layout}}', '_type', '{{cat_layout_type}}', 'id');
        $this->addForeignKey('FK-layout-project','{{layout}}', '_project', '{{project}}', 'id');
        $this->addForeignKey('FK-layout_option-layout','{{layout_option}}', '_layout', '{{layout}}', 'id');
        $this->addForeignKey('FK-layout_option-cat_layout_option','{{layout_option}}', '_option', '{{cat_layout_option}}', 'id');
        $this->addForeignKey('FK-grade-project','{{grade}}', '_project', '{{project}}', 'id');
        $this->addForeignKey('FK-grade-cat_grade_type','{{grade}}', '_type', '{{cat_grade_type}}', 'id');
        $this->addForeignKey('FK-grade_construct-grade','{{grade_construct}}', '_grade', '{{grade}}', 'id');
        $this->addForeignKey('FK-grade_construct-cat_construct','{{grade_construct}}', '_construct', '{{cat_construct}}', 'id');
	}

	public function down()
	{
        $this->dropForeignKey('FK-cat_construct-cat_construct_type','{{cat_construct}}');
        $this->dropForeignKey('FK-grade_construct-cat_construct','{{grade_construct}}');
        $this->dropForeignKey('FK-grade_construct-grade','{{grade_construct}}');
        $this->dropForeignKey('FK-grade-cat_grade_type','{{grade}}');
        $this->dropForeignKey('FK-grade-project','{{grade}}');
        $this->dropForeignKey('FK-layout_option-cat_layout_option','{{layout_option}}');
        $this->dropForeignKey('FK-layout_option-layout','{{layout_option}}');
        $this->dropForeignKey('FK-layout-project','{{layout}}');
        $this->dropForeignKey('FK-layout-cat_layout_type','{{layout}}');
        $this->dropForeignKey('FK-project-project_category','{{project}}');
        $this->dropForeignKey('FK-project_category-project_category','{{project_category}}');
        $this->dropForeignKey('FK-project_image-project','{{project_image}}');
        $this->dropForeignKey('FK-project_option-project','{{project_option}}');
        $this->dropForeignKey('FK-project_option-cat_project_option','{{project_option}}');








        $this->dropTable('{{project}}');
        $this->dropTable('{{project_category}}');
        $this->dropTable('{{project_image}}');
        $this->dropTable('{{cat_project_option}}');
        $this->dropTable('{{cat_layout_option}}');
        $this->dropTable('{{cat_layout_type}}');
        $this->dropTable('{{cat_construct_type}}');
        $this->dropTable('{{cat_construct}}');
        $this->dropTable('{{cat_grade_type}}');
        $this->dropTable('{{project_option}}');
        $this->dropTable('{{layout}}');
        $this->dropTable('{{layout_option}}');
        $this->dropTable('{{grade}}');
        $this->dropTable('{{grade_construct}}');

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