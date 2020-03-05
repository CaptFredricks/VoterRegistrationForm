<?php
define('DB_NAME', 'voter_registration');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_HOST', 'localhost');
define('DB_CHAR', 'utf8');

function db_connect() {
	try {
		$conn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHAR, DB_USER, DB_PASS);
		$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // turn off emulated prepare statements
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // turn on error reporting
	} catch(PDOException $e) {
		logError($e);
	}
	
	return $conn;
}

function logError($exception) {
	$timestamp = date('[d-M-Y H:i:s T]', time());
	error_log($timestamp.' '.$exception->getMessage().chr(10), 3, 'error_log'); // create an error log file
}