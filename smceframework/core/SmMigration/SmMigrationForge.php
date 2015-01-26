<?php


/**
 *
 * @author Samed Ceylan
 * @link http://www.samedceylan.com/
 * @copyright 2015 SmceFramework
 * @github https://github.com/smceframework
 */
namespace Smce\Core;

use PDO;

class SmMigrationForge{

	protected $conn;
	
	
	public function getConnection(){
		return $this->conn;
	}

	/**
	 * Return a list of tables within the selected database
	 * @return array
	 */
	public function getTables() {
		
		$rows = $this->conn->query("SHOW TABLES;")->fetchAll(PDO::FETCH_COLUMN, 0);
		$tables = array();
		foreach($rows as $table) {
			$tables[$table] = $table;
		}

		return $tables;
	}
	/**
	 * Check if table exists in the database
	 * @param string $name
	 * @return boolean
	 */
	public function getTable($name) {
		$tables = $this->getTables();
		return isset($tables[$name]) ? true : false;
	}
	/**
	 * Add a column to a table in the database
	 * @param string $table
	 * @param string $column
	 * @param string $defenition
	 * @return boolean
	 */
	public function addColumn($table, $column, $definition) {
		return $this->conn->query("ALTER TABLE `".$table."` ADD `".$column."` ".$definition);
	}
	/**
	 * Drop column from table in database
	 * @param string $table
	 * @param string $column
	 * @return boolean
	 */
	public function dropColumn($table, $column) {
		return $this->conn->query("ALTER TABLE `".$table."` DROP `".$column."`;");
	}
	/**
	 * Empty table in the database
	 * @param string $table
	 * @return int
	 */
	public function truncateTable($table) {
		return $this->conn->query("TRUNCATE TABLE `".$table."`");
	}
	/**
	 * Drop table in the database
	 * @param string $table
	 * @return boolean
	 */
	public function dropTable($table) {
		return $this->conn->query("DROP TABLE `".$table."`");
	}

	/**
	 * Create new table in the database
	 * @param string $table
	 * @param array $values
	 * @return int
	 */
	public function createTable($name, $columns, $props=null) {
		$dbColumns = array();
		foreach($columns as $key => $value) {
			$dbColumns[] = "\t`".$key."` $value";
		}
		
		$sql  = "CREATE TABLE `".$name."` (\n";
		$sql .= implode(",\n", $dbColumns);
		$sql .= "\n\t)";
		
		// Do we have properties
		if($props) {
			$sql .= ' '.$props;
		}
		
		// Finish
		$sql .= ';';
		
		return $this->conn->query($sql);
		
	}


	/**
	 * Insert records into a table
	 * @param string $table
	 * @param array $values
	 * @return int
	 */
	public function insert($table, $data) {
		$columns      = array();
		$placeholders = array();

		foreach ($data as $key => $val) {
			$columns[]      = "`".$key."`";
			$placeholders[] = ":$key";
		}

		$columns      = implode(', ', $columns);
		$placeholders = implode(', ', $placeholders);

		$sql   = "INSERT INTO `".$table."` ($columns) VALUES ($placeholders);";

		return $this->conn->query($sql,$data);
	}
	
	/**
	 * Update records in a table
	 * @param string $table
	 * @param array $data
	 * @param string $condition
	 * @param array $params
	 * @return int
	 */
	public function update($table, $data, $condition=null) {		
		// Prepare values
		$values2=array();
		foreach($data as $a => $b) {
			$values[] = "`$a`=:$a";
			$values2[":$a"]= $b;
		}
		
		// Implode values
		$values = implode(', ', $values);

		// Do we have a condition
		$where = '';
		if($condition) {
			// Add to where
			$where = ' WHERE ' . $condition;
		}

		$sql = "UPDATE `".$table."` SET $values{$where}";


		return $this->conn->query($sql,$values2);
	}
	
	/**

	 * @param sring $table
	 *
	 * @return Attributes
	 *
	*/
	public function getAttributes($table)
	{
		return $this->conn->query("SHOW COLUMNS FROM ".$table)->fetchAll();
		
	}
	
	
	/**

	 * @param sring $table
	 *
	 * @return Attributes
	 *
	*/
	public function getPrimaryKey($table)
	{
		return $this->conn->query("SHOW KEYS FROM ".$table. " WHERE Key_name = 'PRIMARY'")->fetchAll();
		
	}
}