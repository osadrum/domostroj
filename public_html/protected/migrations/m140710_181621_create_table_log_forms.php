<?php

class m140710_181621_create_table_log_forms extends CDbMigration
{
	public function up()
	{
        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Отправка уведомлений',
            'name' => 'smsApiUrl',
            'value' => 'http://sms.ru/sms/send',
            'title' => 'SMS API URL',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Отправка уведомлений',
            'name' => 'smsApiKey',
            'value' => '10e3b70f-2eed-5364-210f-3fcd3687e8d9',
            'title' => 'SMS API KEY',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'bool',
            'section' => 'Отправка уведомлений',
            'name' => 'smsName',
            'value' => 0,
            'title' => 'SMS Использовать имя отправителя',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Отправка уведомлений',
            'name' => 'smsFrom',
            'value' => 'rangeweb',
            'title' => 'SMS Имя отправителя',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Настройки SMTP',
            'name' => 'smtpHost',
            'value' => 'smtp.beget.ru',
            'title' => 'SMTP Сервер',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Настройки SMTP',
            'name' => 'smtpPort',
            'value' => 2525,
            'title' => 'SMTP Порт',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Настройки SMTP',
            'name' => 'smtpEmail',
            'value' => '',
            'title' => 'SMTP адрес эл.почты',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Настройки SMTP',
            'name' => 'smtpPass',
            'value' => '',
            'title' => 'SMTP Пароль',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Настройки SMTP',
            'name' => 'smtpName',
            'value' => 'Уютный дом',
            'title' => 'SMTP Имя отправителя',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'bool',
            'section' => 'Отправка уведомлений',
            'name' => 'contact-sms',
            'value' => 0,
            'title' => 'СМС уведомление из контактной формы',
        ));

        $this->createTable('{{log_forms}}', array(
            'id' => 'pk',
            'form' => 'tinyint(1)',
            'notice' => 'tinyint(1)',
            'phone' => 'varchar(16)',
            'email' => 'varchar(50)',
            'message' => 'text',
            'ip' => 'varchar(20)',
            'url' => 'varchar(150)',
            'datetime' => 'datetime',
        ));
	}

	public function down()
	{
		$this->dropTable('{{log_forms}}');
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