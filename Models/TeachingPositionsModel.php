<?php
require_once 'HelpClass.php';
/**
 * 
 * @author lastride
 *
 */
class TeachingPositionsModel {
	/**
	 * Получаем все препод должности
	 */
	public static function getAllTeachingPositions() {
		$query = "SELECT id_teaching_position, title FROM teaching_positions";
		return HelpClass::getQuery($query, "Невозможно получить все препод должности", __FUNCTION__);
	}
	/**
	 * Получаем название препод должности по её id
	 * @param id препод должности $id_teaching_position
	 */
	public static function getTeachingPositionTitleById($id_teaching_position) {
		$query = "SELECT title FROM teaching_positions WHERE id_teaching_position = {$id_teaching_position}";
		return HelpClass::getQuery($query, "Невозможно получить название препод должности по её id", __FUNCTION__)->fetchColumn(0);
	}
}
?>