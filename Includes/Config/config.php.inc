<?php

define('DB_DSN', 'mysql:host=eu-cdbr-azure-north-e.cloudapp.net;dbname=acsm_50e2768e7b81018');
define('DB_LOGIN', 'bfe45e648a7e95');
define('DB_PASSWORD', '8aadcf5c');


class Config {
	private static  $_instanceOf = NULL;
	private $pdo;
	private function __construct() {
		try {
			$this->pdo = new PDO(DB_DSN, DB_LOGIN, DB_PASSWORD);
		}
		catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	public static function getInstance() {
		if (self::$_instanceOf == NULL) {
			self::$_instanceOf = new Config();
		}
		return self::$_instanceOf;
	}
	public function getPDO() {
		return $this->pdo;
	}
}
?>
