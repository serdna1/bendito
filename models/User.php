<?php

namespace Model;

class User extends ActiveRecord {
	// database
	protected static $table = 'users';
	protected static $columnsDB = ['id', 'username', 'email', 'password'];

	public $id;
	public $username;
	public $email;
	public $password;

	public function __construct($args = []) {
		$this->id = $args['id'] ?? null;
		$this->username = $args['username'] ?? '';
		$this->email = $args['email'] ?? '';
		$this->password = $args['password'] ?? '';
	}

	// Validation messages for account creation
	public function validateNewAccount() {
		if(!$this->username) {
			self::$alerts['error'][] = 'Username is required';
		}
		if(!$this->email) {
			self::$alerts['error'][] = 'Email is required';
		}
		if(!$this->password) {
			self::$alerts['error'][] = 'Password is required';
		}
		if(strlen($this->password) < 6) {
			self::$alerts['error'][] = 'Password must be at least 6 characters long';
		}

		return self::$alerts;
	}

	// Validation messages for login
	public function validateLogin() {
		if(!$this->email) {
			self::$alerts['error'][] = 'Email is required';
		}
		if(!$this->password) {
			self::$alerts['error'][] = 'Password is required';
		}

		return self::$alerts;
	}

	public function userExists() {
		$query = " SELECT * FROM " . self::$table . " WHERE email = '" . $this->email . "' LIMIT 1";

		$result = self::$db->query($query);

		if($result->num_rows) {
			self::$alerts['error'][] = 'User already exists';
		}

		return $result;
	}

	public function hashPassword() {
		$this->password = password_hash($this->password, PASSWORD_BCRYPT);
	}

	public function verifyPassword($password) {
		$result = password_verify($password, $this->password);
		
		if (!$result) {
			self::$alerts['error'][] = 'Incorrect email or password';
		} else {
			return true;
		}
	}

}