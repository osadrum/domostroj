<?php

class m140417_082121_create_table_settings extends CDbMigration
{
	public function up()
	{
        $this->createTable('{{settings}}', array(
            'id' => 'int(4) NOT NULL AUTO_INCREMENT PRIMARY KEY',
            'type' => 'varchar(50) NOT NULL',
            'section' => 'varchar(100) NOT NULL',
            'name' => 'varchar(100) NOT NULL',
            'value' => 'text NOT NULL',
            'title' => 'varchar(255) NOT NULL',
            'date_update' => 'datetime',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Общие',
            'name' => 'siteName',
            'value' => '',
            'title' => 'Название сайта',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Общие',
            'name' => 'googleAnalytics',
            'value' => '',
            'title' => 'Код Google Analytics',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Общие',
            'name' => 'yandexMetrika',
            'value' => '',
            'title' => 'Код Яндекс Метрика',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'email',
            'value' => '',
            'title' => 'E-mail администратора',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'hotLinePhone',
            'value' => '',
            'title' => 'Телефон Горячей линии',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'phone',
            'value' => '',
            'title' => 'Телефон',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'address',
            'value' => '',
            'title' => 'Адрес',
        ));


        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'contactText',
            'value' => '',
            'title' => 'Дополнительный текст',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'map',
            'value' => '',
            'title' => 'Код карты',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'orgName',
            'value' => '',
            'title' => 'Название организации',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'SEO параметры',
            'name' => 'metaDescription',
            'value' => '',
            'title' => 'Meta описание',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'SEO параметры',
            'name' => 'metaKeywords',
            'value' => '',
            'title' => 'Meta ключевые слова',
        ));
	}

	public function down()
	{
		$this->dropTable('{{settings}}');
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