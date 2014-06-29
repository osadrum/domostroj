<?php

class m140629_192317_insert_table_settings extends CDbMigration
{
	public function up()
	{
        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Отправка уведомлений',
            'name' => 'appPhone',
            'value' => '79536401515',
            'title' => 'Номер телефона для принятия заявок',
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