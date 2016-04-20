<?php
require_once '../Includes/Config/config.php.inc';
class HelpClass {
/**
	 *
	 * Выполняем запрос
	 * @param запрос $query
	 * @param сообщение исключения $exception_message
	 * @param имя функции $function
	 * @throws PDOException
	 */
	public static function getQuery($query, $exception_message, $function) {
		$pdo = Config::getInstance()->getPDO();
		$exec = $pdo->query($query);
		if (! $exec) {
			throw new PDOException($exception_message."{".__CLASS__.".".$function."}");
		}
		else return $exec;
	}
	/**
	 *
	 * Выполняем запрос exec (на update delete insert)
	 * @param запрос $query
	 * @param сообщение исключения $exception_message
	 * @param имя функции $function
	 * @throws PDOException
	 */
	public static function getExec($exec_query, $exception_message, $function) {
		$pdo = Config::getInstance()->getPDO();
		$exec = $pdo->exec($exec_query);
		if (! $exec) {
			throw new PDOException($exception_message."{".__CLASS__.".".$function."}");
		}
		else return $exec;
	}
	public static function getLastInsertedId() {
		$pdo = Config::getInstance()->getPDO();
		return $pdo->lastInsertId();
	}
}

?>