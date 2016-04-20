<?php
require_once 'HelpClass.php';
/**
 * 
 * @author lastride
 *
 */
class ChairsModel {
	/**
	 * Получаем все кафедры
	 */
	public static function getAllChairs() {
		$query = "SELECT id_chair, abbr, title, id_faculty, address, telephone, id_teacher_head FROM chairs";
		return HelpClass::getQuery($query, "Невозможно получить все кафедры", __FUNCTION__);
	}
	public static function getAllChairsByFacultyId($id_faculty) {
		$query = "SELECT id_chair, abbr, title, id_faculty, address, telephone, id_teacher_head
					 FROM chairs
						WHERE id_faculty = {$id_faculty}";
		return HelpClass::getQuery($query, "Невозможно получить все кафедры по id факультета", __FUNCTION__);
	}
	/**
	 * Получаем аббревиатуру кафедры по её id
	 * @param id кафедры $id_chair
	 */
	public static function getChairAbbrById($id_chair) {
		$query = "SELECT abbr FROM chairs WHERE id_chair = {$id_chair}";
		return HelpClass::getQuery($query, "Невозможно получить аббревиатуру кафедры по её id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем название кафедры по id 
	 * @param id кафедры $id_chair
	 */
	public static function getChairTitleById($id_chair) {
		$query = "SELECT title FROM chairs WHERE id_chair = {$id_chair}";
		return HelpClass::getQuery($query, "Невозможно получить название кафедры по её id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем id факультета по id кафедры
	 * @param unknown_type $id_chair
	 */
	public static function getFacultyIdByChairId($id_chair) {
		$query = "SELECT id_faculty FROM chairs WHERE id_chair = {$id_chair}";
		return HelpClass::getQuery($query, "Невозможно получить id факультета по id кафедры", __FUNCTION__)->fetchColumn(0);
	}
	public static function getAllChairsIdByFacultyId($id_faculty) {
		$query = "SELECT id_chair FROM chairs WHERE id_faculty = {$id_faculty}";
		return HelpClass::getQuery($query, "Невозможно получить id факультета по id кафедры", __FUNCTION__);
	}
	/**
	 * Получаем адрес кафедры по её id
	 * @param id кафедры $id_chair
	 */
	public static function getChairAddressByChairId($id_chair) {
		$query = "SELECT address FROM chairs WHERE id_chair = {$id_chair}";
		return HelpClass::getQuery($query, "Невозможно получить адрес кафедры по её id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем телефон кафедры по её id
	 * @param id кафедры $id_chair
	 */
	public static function getChairTelephoneByChairId($id_chair) {
		$query = "SELECT telephone FROM chairs WHERE id_chair = {$id_chair}";
		return HelpClass::getQuery($query, "Невозможно получить телефон кафедры по её id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем id преподавателя (заведующего кафедрой) по id кафедры
	 * @param unknown_type $id_chair
	 */
	public static function getTeacherHeadIdByChairId($id_chair) {
		$query = "SELECT id_teacher_head FROM chairs WHERE id_chair = {$id_chair}";
		return HelpClass::getQuery($query, "Невозможно получить заведующего кафедры по её id", __FUNCTION__)->fetchColumn(0);
	}
	public static function checkFacultyContainsChair($id_faculty, $id_chair) {
		$query = "SELECT id_chair FROM chairs WHERE id_chair = {$id_chair} AND id_faculty = {$id_faculty}";
		return (HelpClass::getQuery($query, "Невозможно получить соответствие кафедры и факультета", __FUNCTION__)->fetchColumn(0) != "") ? true : false;
	}
	public static function insertChair($abbr, $title, $id_faculty, $address, $telephone, $id_teacher_head) {
		$query = "INSERT INTO chairs(abbr, title, id_faculty, address, telephone, id_teacher_head)
					VALUES('".$abbr."', '".$title."', {$id_faculty}, '".$address."', '".$telephone."', {$id_teacher_head})";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
	public static function deleteChairById($id_chair) {
		$query = "DELETE FROM chairs WHERE id_chair = {$id_chair}";
		return HelpClass::getExec($query, "Невозможно удалить запись", __FUNCTION__);
	}
	public static function getChairsCount() {
		$query = "SELECT count(id_chair) as count FROM chairs ";
		return HelpClass::getQuery($query, "Невозможно получить количество кафедр", __FUNCTION__)->fetchColumn(0);
	}
}
?>