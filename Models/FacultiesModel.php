<?php
require_once 'HelpClass.php';

class FacultiesModel {
	/**
	 * Получаем все факультеты
	 */
	public static function getAllFaculties() {
		$query = "SELECT id_faculty, abbr, title, id_institute FROM faculties";
		return HelpClass::getQuery($query, "Невозможно получить все факультеты", __FUNCTION__);
	}
	public static function getAllFacultiesByInstituteId($id_institute) {
		$query = "SELECT id_faculty, abbr, title, id_institute FROM faculties WHERE id_institute = {$id_institute}";
		return HelpClass::getQuery($query, "Невозможно получить все факультеты по id института", __FUNCTION__);
	}
	/**
	 * Получаем аббревиатуру факультета по его id 
	 * @param id факультета $id_faculty
	 */
	public static function getFacultyAbbrById($id_faculty) {
		$query = "SELECT abbr FROM faculties WHERE id_faculty = {$id_faculty}";
		return HelpClass::getQuery($query, "Невозможно получить аббревиатуру факультета по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем название факультета по его id
	 * @param unknown_type $id_faculty
	 */
	public static function getFacultyTitleById($id_faculty) {
		$query = "SELECT title FROM faculties WHERE id_faculty = {$id_faculty}";
		return HelpClass::getQuery($query, "Невозможно получить название факультета по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем id института по id факультета
	 * @param id факультета $id_faculty
	 */
	public static function getInstituteIdByFacultyId($id_faculty) {
		$query = "SELECT id_institute FROM faculties WHERE id_faculty = {$id_faculty}";
		return HelpClass::getQuery($query, "Невозможно получить id института по id факультета", __FUNCTION__)->fetchColumn(0);
	}
	
/**
	 * Получаем id факультета по id института
	 * @param id факультета $id_faculty
	 */
	public static function getFacultyIdByInstituteId($id_institute) {
		$query = "SELECT id_faculty FROM faculties WHERE id_institute = {$id_institute}";
		return HelpClass::getQuery($query, "Невозможно получить id факультета по id института", __FUNCTION__)->fetchColumn(0);
	}
	public static function insertFaculty($id_institute, $abbr, $title) {
		$query = "INSERT INTO faculties(id_institute, abbr, title) VALUES({$id_institute}, '".$abbr."', '".$title."')";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
	public static function deleteFacultyById($id_faculty) {
		$query = "DELETE FROM faculties WHERE id_faculty = {$id_faculty}";
		return HelpClass::getExec($query, "Невозможно удалить запись", __FUNCTION__);
	}
	public static function getFacultiesCount() {
		$query = "SELECT count(id_faculty) as count FROM faculties ";
		return HelpClass::getQuery($query, "Невозможно получить количество кафедр>", __FUNCTION__)->fetchColumn(0);
	}
}

?>