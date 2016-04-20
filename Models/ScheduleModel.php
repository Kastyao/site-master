<?php
require_once 'HelpClass.php';

class ScheduleModel {
	public static function getAllSchedule() {
		$query = "SELECT id_schedule, id_time, id_week, id_teacher, id_subject, cabinet 
					FROM schedule";
		return HelpClass::getQuery($query, "Невозможно получить все расписание", __FUNCTION__);
	}
	public static function getAllScheduleByTeacherId($id_teacher) {
		$query = "SELECT id_schedule, id_time, id_week, id_teacher, id_subject, cabinet
					FROM schedule WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить все расписание по id препода", __FUNCTION__);
	}
	public static function checkTeacherId($id_teacher) {
		$query = "SELECT id_schedule FROM schedule WHERE id_teacher = {$id_teacher}";
		return (HelpClass::getQuery($query, "Невозможно получить соответствие", __FUNCTION__)->fetchColumn(0) != "") ? true : false;
	}
	public static function checkWeekId($id_week, $id_teacher) {
		$query = "SELECT id_schedule FROM schedule WHERE id_week = {$id_week} AND id_teacher = {$id_teacher}";
		return (HelpClass::getQuery($query, "Невозможно получить соответствие", __FUNCTION__)->fetchColumn(0) != "") ? true : false;
	}
	public static function getScheduleByTeacherAndWeekId($id_teacher, $id_week) {
		$query = "SELECT id_schedule, id_time, id_week, id_teacher, id_subject, cabinet
		FROM schedule WHERE id_teacher = {$id_teacher} AND id_week = {$id_week}";
		return HelpClass::getQuery($query, "Невозможно получить все расписание по id препода и дня недели", __FUNCTION__);
	}
	
	public static function insertSchedule($id_time, $id_week, $id_teacher, $id_subject, $cabinet) {
		$query = "INSERT INTO schedule(id_time, id_week, id_teacher, id_subject, cabinet)
		VALUES({$id_time}, {$id_week}, {$id_teacher}, {$id_subject}, {$cabinet})";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
}

?>