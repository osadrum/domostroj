<?php

class m140628_130616_alter_table_project extends CDbMigration
{
	public function up()
	{
        $this->addColumn('{{project}}', 'area', 'decimal(8,2)');
        $this->addColumn('{{project}}', 'floor', 'int(2)');
	}

	public function down()
	{
		$this->dropColumn('{{project}}', 'area');
		$this->dropColumn('{{project}}', 'floor');
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