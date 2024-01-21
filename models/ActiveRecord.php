<?php

namespace Model;

class ActiveRecord {

	protected static $db;
	protected static $table = '';
	protected static $columnsDB = [];

	protected static $alerts = [];
	
	// Define DB connection - /includes/database.php
	public static function setDB($database) {
		self::$db = $database;
	}

	public static function setAlert($type, $message) {
		static::$alerts[$type][] = $message;
	}

	// Validation
	public static function getAlerts() {
		return static::$alerts;
	}

	public function validate() {
		static::$alerts = [];
		return static::$alerts;
	}

	// SQL query to create an object in memory for each row in the db
	public static function querySQL($query) {
		$result = self::$db->query($query);

		$array = [];
		while ($row = $result->fetch_assoc()) {
			$array[] = static::createObject($row);
		}

		$result->free();

		return $array;
	}

	// Crea the object in memory that corresponds to the DB row
	protected static function createObject($row) {
		$object = new static;

		foreach ($row as $key => $value ) {
			if (property_exists( $object, $key  )) {
				$object->$key = $value;
			}
		}

		return $object;
	}

	// Get class atributes as an associative array
	public function atributes() {
		$atributes = [];
		foreach (static::$columnsDB as $column) {
			if ($column === 'id') continue;
			$atributes[$column] = $this->$column;
		}
		return $atributes;
	}

	// Get sanitized data before storing it in the DB
	public function sanitizeAtributes() {
		$atributes = $this->atributes();
		$sanitized = [];
		foreach ($atributes as $key => $value ) {
			$sanitized[$key] = self::$db->escape_string($value);
		}
		return $sanitized;
	}

	// Sincroniza DB with object
	public function sincronize($args=[]) { 
		foreach ($args as $key => $value) {
		  if (property_exists($this, $key) && !is_null($value)) {
				$this->$key = $value;
		  }
		}
	}

	// Create or update row on db depending on wether the id atribute exists
	public function save() {
		$result = '';
		if(!is_null($this->id)) {
			$result = $this->update();
		} else {
			$result = $this->create();
		}
		return $result;
	}

	// Get all rows from the table
	public static function all() {
		$query = "SELECT * FROM " . static::$table;
		$resultado = self::querySQL($query);
		return $resultado;
	}

	// Find a row by id
	public static function find($id) {
		$query = "SELECT * FROM " . static::$table  ." WHERE id = $id";
		$result = self::querySQL($query);
		return array_shift( $result ) ;
	}

	// Get n rows
	public static function get($n) {
		$query = "SELECT * FROM " . static::$table . " LIMIT $n";
		$resultado = self::querySQL($query);
		return array_shift( $resultado ) ;
	}

	// Get the first row that match a column value
	public static function where($column, $value) {
		$query = "SELECT * FROM " . static::$table  ." WHERE $column = '$value'";
		$result = self::querySQL($query);
		return array_shift( $result ) ;
	}

	// Plain SQL query (use when the model methods are not enough)
	public static function SQL($query) {
		$result = self::querySQL($query);
		return $result;
	}

	// Create a new row
	public function create() {
		$atributes = $this->sanitizeAtributes();

		$query = " INSERT INTO " . static::$table . " ( ";
		$query .= join(', ', array_keys($atributes));
		$query .= " ) VALUES (' "; 
		$query .= join("', '", array_values($atributes));
		$query .= " ') ";
		
		$result = self::$db->query($query);
		
		return [
		  'result' =>  $result,
		  'id' => self::$db->insert_id
		];
	}

	// Update a row
	public function update() {
		$atributes = $this->sanitizeAtributes();

		// Format atributes as strings with the format "$key='$value'" before using them on the SQL query
		$key_value_string_array = [];
		foreach ($atributes as $key => $value) {
			$key_value_string_array[] = "$key='$value'";
		}

		$query = "UPDATE " . static::$table ." SET ";
		$query .=  join(', ', $key_value_string_array );
		$query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
		$query .= " LIMIT 1 "; 

		$result = self::$db->query($query);
		
		return $result;
	}

	// Remove a row by id
	public function delete() {
		$query = "DELETE FROM "  . static::$table . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
		$result = self::$db->query($query);
		return $result;
	}

}