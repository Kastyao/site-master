<?php
require_once 'HelpClass.php';

class LecturesModel {
	public static function getAllLectures() {
		$query = "SELECT id_lecture, title, number, content, id_subject FROM lectures";
		return HelpClass::getQuery($query, "Невозможно получить все лекции", __FUNCTION__);
	}
	public static function getAllLecturesBySubjectId($id_subject) {
		$query = "SELECT id_lecture, title, number, content, id_subject 
					FROM lectures
						WHERE id_subject = {$id_subject} ORDER BY number";
		return HelpClass::getQuery($query, "Невозможно получить все лекции по id предмета", __FUNCTION__);
	}
	public static function getLectureTitleById($id_lecture) {
		$query = "SELECT title FROM lectures WHERE id_lecture = {$id_lecture}";
		return HelpClass::getQuery($query, "Невозможно получить название лекции по её id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getLectureContentById($id_lecture) {
		$query = "SELECT content FROM lectures WHERE id_lecture = {$id_lecture}";
		return HelpClass::getQuery($query, "Невозможно получить содержание лекции по её id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getLectureNumberById($id_lecture) {
		$query = "SELECT number FROM lectures WHERE id_lecture = {$id_lecture}";
		return HelpClass::getQuery($query, "Невозможно получить номер лекции по её id", __FUNCTION__)->fetchColumn(0);
	}
	public static function insertLecture($title, $number, $content, $id_subject) {
		$query = "INSERT INTO lectures(title, number, content, id_subject)
					VALUES('".$title."', {$number}, '".$content."', {$id_subject})";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
	public static function updateLecture($id_lecture, $title, $number, $content) {
		$query = "UPDATE lectures SET title = '".$title."', number = {$number}, content = '".$content."' 
							WHERE id_lecture = {$id_lecture}";
		return HelpClass::getExec($query, "Невозможно изменить запись", __FUNCTION__);
	}
	public static function deleteLecture($id_lecture) {
		$query = "DELETE FROM lectures WHERE id_lecture = {$id_lecture}";
		return HelpClass::getExec($query, "Невозможно удалить запись", __FUNCTION__);
		
	}
}

?>