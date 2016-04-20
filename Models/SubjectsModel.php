<?php
require_once 'HelpClass.php';

class SubjectsModel {
	public static function getAllSubjects() {
		$query = "SELECT id_subject, title, id_teacher, id_faculty,
				 id_chair, id_subject_type, course FROM subjects";
		return HelpClass::getQuery($query, "Невозможно получить все предметы", __FUNCTION__);
	}
	public static function getAllSubjectsByFacultyOrChairId($id_faculty, $id_chair, $course) {
		$query = "SELECT id_subject, title, id_teacher, id_faculty,
						id_chair, id_subject_type, course FROM subjects
						WHERE (id_chair = {$id_chair} OR id_faculty = {$id_faculty}) 
							AND course = {$course} ORDER BY id_subject_type";
		return HelpClass::getQuery($query, "Невозможно получить все предметы по id кафедры и тд", __FUNCTION__);
	}
	public static function getSubjectTitleById($id_subject) {
		$query = "SELECT title FROM subjects WHERE id_subject = {$id_subject} ";
		return HelpClass::getQuery($query, "Невозможно получить название предмета", __FUNCTION__)->fetchColumn(0);
	}
	public static function getSubjectCourseById($id_subject) {
		$query = "SELECT course FROM subjects WHERE id_subject = {$id_subject} ";
		return HelpClass::getQuery($query, "Невозможно получить курс предмета", __FUNCTION__)->fetchColumn(0);
	}
	public static function getSubjectTypeIdById($id_subject) {
		$query = "SELECT id_subject_type FROM subjects WHERE id_subject = {$id_subject} ";
		return HelpClass::getQuery($query, "Невозможно получить название тип предмета", __FUNCTION__)->fetchColumn(0);
	}
	public static function getSubjectChairIdById($id_subject) {
		$query = "SELECT id_chair FROM subjects WHERE id_subject = {$id_subject} ";
		return HelpClass::getQuery($query, "Невозможно получить название тип предмета", __FUNCTION__)->fetchColumn(0);
	}
	public static function getSubjectFacultyIdById($id_subject) {
		$query = "SELECT id_faculty FROM subjects WHERE id_subject = {$id_subject} ";
		return HelpClass::getQuery($query, "Невозможно получить название тип предмета", __FUNCTION__)->fetchColumn(0);
	}
	public static function insertSubject($title, $id_teacher, $id_faculty, $id_chair, $id_subject_type,
							$course) {
		$query = "INSERT INTO subjects(title, id_teacher, id_faculty, id_chair, id_subject_type, course)
					VALUES('".$title."', {$id_teacher}, {$id_faculty}, '".$id_chair."', {$id_subject_type}, {$course})";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
	
	public static function deleteSubject($id_subject) {
		$query = "DELETE FROM subjects WHERE id_subject = {$id_subject}";
		return HelpClass::getExec($query, "Невозможно удалить запись", __FUNCTION__);
	}
	public static function getSubjectsCount() {
		$query = "SELECT count(id_subject) as count FROM subjects ";
		return HelpClass::getQuery($query, "Невозможно получить количество предметов", __FUNCTION__)->fetchColumn(0);
	}
	public static function getAllSubjectsByTeacherId($id_teacher) {
		$query = "SELECT id_subject, title, id_teacher, id_faculty,
		id_chair, id_subject_type, course FROM subjects
		WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить все предметы по id преподавателя", __FUNCTION__);
	}
	public static function getAllSubjectsByTeacherIdCourseAndSubjectTypeId($id_teacher, $course, $id_subject_type) {
		$query = "SELECT id_subject, title, id_teacher, id_faculty,
							id_chair, id_subject_type, course FROM subjects
								WHERE id_teacher = {$id_teacher} AND course = {$course} AND id_subject_type = {$id_subject_type}";
		return HelpClass::getQuery($query, "Невозможно получить все предметы по id преподавателя", __FUNCTION__);
	}
	public static function getAllSubjectsByChairOrFacultyIdCourseAndSubjectTypeId($id_chair, $id_faculty, $course, $id_subject_type) {
		$query = "SELECT id_subject, title, id_teacher, id_faculty,
		id_chair, id_subject_type, course FROM subjects
		WHERE (id_chair = {$id_chair} OR id_faculty = {$id_faculty}) AND course = {$course} AND id_subject_type = {$id_subject_type}";
		return HelpClass::getQuery($query, "Невозможно получить все предметы по id преподавателя", __FUNCTION__);
	}
	public static function getAllSubjectsCoursesByTeacherIdAndSubjectTypeId($id_teacher, $id_subject_type) {
		$query = "SELECT DISTINCT course FROM subjects
						WHERE id_teacher = {$id_teacher} AND id_subject_type = {$id_subject_type} ORDER BY course";
		return HelpClass::getQuery($query, "Невозможно получить все курсы предметов по id преподавателя", __FUNCTION__);
	}
}
?>