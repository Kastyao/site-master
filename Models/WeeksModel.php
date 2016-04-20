<?php

require_once 'HelpClass.php';

class WeeksModel {
	public static function getAllWeeks() {
		$query = "SELECT id_week, title FROM weeks";
		return HelpClass::getQuery($query, "Невозможно получить все дни", __FUNCTION__);
	}
	public static function getWeekTitleById($id_week) {
		$query = "SELECT id_week, title FROM weeks WHERE id_week = {$id_week}";
		return HelpClass::getQuery($query, "Невозможно получить название дня по id", __FUNCTION__)->fetchColumn(0);
	}
}

?>