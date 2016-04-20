<?php
require_once 'HelpClass.php';

class SubjectTypesModel {
	/**
	 * Получаем все типы предметов
	 */
	public static function getAllSubjectTypes() {
		$query = "SELECT id_subject_type, title FROM subject_types";
		return HelpClass::getQuery($query, "Невозможно получить все типы предметов", __FUNCTION__);
	}
	/**
	 * Получаем название типа предмета по его id 
	 * @param id типа предмета $id_subject_title
	 */
	public static function getSubjectTypeTitleById($id_subject_type) {
		$query = "SELECT title FROM subject_types WHERE id_subject_type = {$id_subject_type}";
		return HelpClass::getQuery($query, "Невозможно получить название типа предмета по его id", __FUNCTION__)->fetchColumn(0);
	}
	
}
?>