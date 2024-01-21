<?php

$db = mysqli_connect('localhost', 'root', '', 'bendito_db');

if (!$db) {
	echo "Error: Unnable to connect to MySQL.";
	echo "errno de depuración: " . mysqli_connect_errno();
	echo "error de depuración: " . mysqli_connect_error();
	exit;
}
