<?php

class m140627_161842_insert_table_settings extends CDbMigration
{
	public function up()
	{
        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'scheduleWork',
            'value' => 'пн-пт с 9:00 до 19:00',
            'title' => 'График работы',
        ));
	}

	public function down()
	{

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