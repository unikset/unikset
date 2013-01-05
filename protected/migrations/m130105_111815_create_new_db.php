<?php

class m130105_111815_create_new_db extends CDbMigration
{
	public function up()
	{
            $this->addColumn('cities', 'lang', 'varchar(2) NOT NULL DEFAULT "en"');
            $this->addColumn('countries', 'lang', 'char(2) NOT NULL DEFAULT "en"');
            $this->addColumn('discipline', 'lang', 'char(2) NOT NULL DEFAULT "en"');
            $this->addColumn('lecturers', 'lang', 'char(2) NOT NULL DEFAULT "en"');
            $this->addColumn('regions', 'lang', 'varchar(2) NOT NULL DEFAULT "en"');
	}

	public function down()
	{
            $this->dropColumn('cities', 'lang');
            $this->dropColumn('countries', 'lang');
            $this->dropColumn('discipline', 'lang');
            $this->dropColumn('lecturers', 'lang');
            $this->dropColumn('regions', 'lang');
		//echo "m130105_111815_create_new_db does not support migration down.\n";
		//return false;
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