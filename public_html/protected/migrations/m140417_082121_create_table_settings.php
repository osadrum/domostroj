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
            'value' => 'admin@example.com',
            'title' => 'E-mail администратора',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'phone',
            'value' => '+7(495) 780-34-94',
            'title' => 'Телефон',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'address',
            'value' => '141400, МО, г. Химки, Бутаково, д.4',
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
            'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2237.597054187131!2d37.436148800000005!3d55.88700399999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46b538f56cf4ab4d%3A0x2fbc9cfeadc01488!2z0YPQuy4g0JHRg9GC0LDQutC-0LLQsCwgNCwg0KXQuNC80LrQuCwg0JzQvtGB0LrQvtCy0YHQutCw0Y8g0L7QsdC70LDRgdGC0YwsINCg0L7RgdGW0Y8!5e0!3m2!1suk!2sua!4v1394022061308" width="700" height="330" frameborder="0" style="border:0"></iframe>',
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