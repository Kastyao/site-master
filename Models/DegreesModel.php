<?php
require_once 'HelpClass.php';
/**
 * 
 * @author lastride
 *
 */
class DegreesModel {
	/**
	 * Получаем все учёные степени
	 */
	public static function getAllDegrees() {
		$query = "SELECT id_degree, title FROM degrees";
		return HelpClass::getQuery($query, "Невозможно получить все учёные степени", __FUNCTION__);
	}
	/**
	 * Получаем название учёной степени по её id
	 * @param id научной степени $id_degree
	 */	
	public static function getDegreeTitleById($id_degree) {
		$query = "SELECT title FROM degrees WHERE id_degree = {$id_degree}";
		return HelpClass::getQuery($query, "Невозможно получить учёную степень по её id", __FUNCTION__)->fetchColumn(0);
	}
}
?>