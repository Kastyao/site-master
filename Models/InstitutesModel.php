<?php
require_once 'HelpClass.php';

class InstitutesModel {
	/*
	 * Получаем все институты
	 */
	public static function getAllInstitutes() {
		$query = "SELECT id_institute, abbr, title FROM institutes";
		return HelpClass::getQuery($query, "Невозможно получить все институты", __FUNCTION__);
	}
	/**
	 * Получаем аббревиатуру института по его id 
	 * @param id института $id_institute
	 */
	public static function getInstituteAbbrById($id_institute) {
		$query = "SELECT abbr FROM institutes WHERE id_institute = {$id_institute}";
		return HelpClass::getQuery($query, "Невозможно получить аббревиатуру института по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем название института по его id
	 * @param id института $id_institute
	 */
	public static function getInstituteTitleById($id_institute) {
		$query = "SELECT title FROM institutes WHERE id_institute = {$id_institute}";
		return HelpClass::getQuery($query, "Невозможно получить полное название института по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем id института по его названию
	 * @param unknown_type $title
	 */
	public static function getInstituteIdByTitle($title) {
		$query = "SELECT id_institute FROM institutes WHERE title like '".$title."'";
		return HelpClass::getQuery($query, "Невозможно получить id института по его названию", __FUNCTION__)->fetchColumn(0);
	}
	public static function insertIntoInstitutes($abbr, $title) {
		$query = "INSERT INTO institutes(abbr, title) VALUES ('".$abbr."', '".$title."')";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
	public static function deleteInstituteById($id_institute) {
		$query = "DELETE FROM institutes WHERE id_institute = {$id_institute}";
		return HelpClass::getExec($query, "Невозможно удалить запись", __FUNCTION__);
	}
	public static function getInstitutesCount() {
		$query = "SELECT count(id_institute) as count FROM institutes ";
		return HelpClass::getQuery($query, "Невозможно получить количество институтов", __FUNCTION__)->fetchColumn(0);
	}
}
?>