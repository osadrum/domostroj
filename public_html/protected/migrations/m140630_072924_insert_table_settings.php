<?php

class m140630_072924_insert_table_settings extends CDbMigration
{
	public function up()
	{
        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'coords',
            'value' => '57.7672,40.9271',
            'title' => 'Координаты для карты',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'mapZoom',
            'value' => '15',
            'title' => 'Масштаб карты',
        ));

        $this->insert('{{settings}}', array(
            'type' => 'text',
            'section' => 'Контакты',
            'name' => 'markerText',
            'value' => '<h2>Я хочу дом</h2>',
            'title' => 'Текст на маркере карты',
        ));
	}

	public function down()
	{
		echo "m140630_072924_insert_table_settings does not support migration down.\n";
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