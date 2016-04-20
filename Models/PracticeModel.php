<?php
require_once 'HelpClass.php';

class PracticeModel {
	public static function getAllPracticeByLectureId($id_lecture) {
		$query = "SELECT id_practice, title, id_lecture FROM practice WHERE id_lecture = {$id_lecture}";
		return HelpClass::getQuery($query, "Невозможно получить все практики по id лекции", __FUNCTION__);
	}
	
	public static function getPracticeTitleById($id_practice) {
		$query = "SELECT title FROM practice WHERE id_practice = {$id_practice}";
		return HelpClass::getQuery($query, "Невозможно получить название теста по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getLectureIdByPracticeId($id_practice) {
		$query = "SELECT id_lecture FROM practice WHERE id_practice = {$id_practice}";
		return HelpClass::getQuery($query, "Невозможно получить id лекции id теста", __FUNCTION__)->fetchColumn(0);
	}
	public static function insertPractice($title, $id_lecture) {
		$query = "INSERT INTO practice(title, id_lecture) VALUES('".$title."', {$id_lecture})";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
}
?>