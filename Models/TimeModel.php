<?php
require_once 'HelpClass.php';

class TimeModel {
	public static function getAllTime() {
		$query = "SELECT id_time, title FROM time";
		return HelpClass::getQuery($query, "Невозможно получить все время", __FUNCTION__);
	}
	public static function getTimeTitleById($id_time) {
		$query = "SELECT title FROM time WHERE id_time = {$id_time}";
		return HelpClass::getQuery($query, "Невозможно получить название время по id", __FUNCTION__)->fetchColumn(0);
	}
	
}

?>