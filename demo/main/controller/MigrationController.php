<?php

use Smce\Core\SmController;

use Smce\Core\SmException;
use Smce\Core\SmMigration;

class MigrationController extends SmController
{

    public $layout='//layouts/column1';
	
	public function actionTables()
	{

		$migration=new SmMigration("db1");

		$tables=$migration->getTables();
		echo "<pre>";
		print_r($tables);
		
		
	}


	public function actionTable()
	{

		$migration=new SmMigration("db1");

		$table=$migration->getTable("table_name");
		echo $table; //bool
	}

	public function actionAddcolumn()
	{

		$migration=new SmMigration("db1");

		$migration->addColumn("table_name","columnname","INT");
		
	}


	public function actionDropcolumn()
	{

		$migration=new SmMigration("db1");

		$migration->dropColumn("table_name","columnname");
		
	}


	public function actionDroptable()
	{

		$migration=new SmMigration("db1");

		$migration->dropTable("table_name");
		
	}
	

	public function actionTruncatetable()
	{

		$migration=new SmMigration("db1");

		$migration->truncateTable("table_name");
		
	}


	public function actionCreatetable()
	{

		$migration=new SmMigration("db1");

		$columns=array(
			"id"	=> 	"INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
			"name"	=>	"VARCHAR(30) NOT NULL"
		);

		$props="ENGINE = innodb ;";

		$migration->createTable("table_name",$columns,$props);
		
	}

	public function actionInsert()
	{

		$migration=new SmMigration("db1");

		$data=array(
			"name"=>"test"
		);

		$migration->insert("table_name",$data);
		
	}


	public function actionUpdate()
	{

		$migration=new SmMigration("db1");

		$data=array(
			"name"=>"new name"
		);

		$condition="id=1";

		$migration->update("table_name",$data,$condition);
		
	}
	
}