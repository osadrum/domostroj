<?php

class m140627_104114_alter_table_settings extends CDbMigration
{
	public function up()
	{
        $this->insert('{{settings}}', array(
            'type' => 'send',
            'section' => 'Отправка уведомлений',
            'name' => 'feedback',
            'value' => '',
            'title' => 'Обратная связь',
        ));
	    $this->insert('{{settings}}', array(
            'type' => 'send',
            'section' => 'Отправка уведомлений',
            'name' => 'callback',
            'value' => '',
            'title' => 'Обратный звонок',
        ));
	    $this->insert('{{settings}}', array(
            'type' => 'send',
            'section' => 'Отправка уведомлений',
            'name' => 'order',
            'value' => '',
            'title' => 'Заказ проекта',
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