<?php

class m140630_091146_insert_table_settings extends CDbMigration
{
	public function up()
	{
        $this->insert('{{settings}}', array(
            'type' => 'text-redactor',
            'section' => 'Главная страница',
            'name' => 'about',
            'value' => '',
            'title' => 'Текст "О компании"',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Виджеты',
            'name' => 'numReviews',
            'value' => '3',
            'title' => 'Отзывы - Количество выводимых отзывов',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Виджеты',
            'name' => 'numProjects',
            'value' => '8',
            'title' => 'Проекты - Количество выводимых проектов',
        ));
	}

	public function down()
	{
		echo "m140630_091146_insert_table_settings does not support migration down.\n";
		return false;
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