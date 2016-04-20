<?php
require_once 'HelpClass.php';

class TeachersModel {
	/**
	 * Получаем всех учителей
	 * @return PDOStatement
	 */
	public static function getAllTeachers() {
		$query = "SELECT id_teacher, login, password, firstName, lastName, middleName, telephone, email,
						id_chair, id_teaching_position, id_degree, birthday, photo FROM teachers";
		return HelpClass::getQuery($query, "Невозможно получить всех учителей", __FUNCTION__);
	}
	public static function getTeachersFullNameByChairId($id_chair) {
		$query = "SELECT id_teacher, concat(lastName, ' ', firstName, ' ', middleName) as fullName 
					FROM teachers
						WHERE id_chair = {$id_chair} ORDER BY lastName";
		return HelpClass::getQuery($query, "Невозможно получить всех учителей по id кафедры", __FUNCTION__);
	}
	public static function getAllTeachersByChairId($id_chair) {
		$query = "SELECT id_teacher, login, password, concat(lastName, ' ', firstName, ' ', middleName) as fullName, telephone, email,
						id_chair, id_teaching_position, id_degree, birthday, photo 
				FROM teachers
					WHERE id_chair = {$id_chair}";
		return HelpClass::getQuery($query, "Невозможно получить всех учителей по id кафедры", __FUNCTION__);
	}
	public static function getTeacherById($id_teacher) {
		$query = "SELECT id_teacher, login, password, concat(lastName, ' ', firstName, ' ', middleName) as fullName, telephone, email,
							id_chair, id_teaching_position, id_degree, birthday, photo
						FROM teachers
							WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить учителя по id", __FUNCTION__);
	}
	/**
	 * Получаем логин учителя по его id
	 * @param id учителя $id_student
	 * @return string
	 */
	public static function getTeacherLoginById($id_teacher) {
		$query = "SELECT login FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить логин учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getTeacherIdByLogin($login) {
		$query = "SELECT id_teacher FROM teachers WHERE login like '".$login."'";
		return HelpClass::getQuery($query, "Невозможно получить id учителя по его логину", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем имя учителя по его id
	 * @param id учителя $id_student
	 * @return string
	 */
	public static function getTeacherFirstNameById($id_teacher) {
		$query = "SELECT firstName FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить имя учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем фамилию учителя по его id
	 * @param id учителя $id_student
	 * @return string
	 */
	public static function getTeacherLastNameById($id_teacher) {
		$query = "SELECT lastName FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить фамилию учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем отчество учителя по его id
	 * @param id учителя $id_student
	 * @return string
	 */
	public static function getTeacherMiddleNameById($id_teacher) {
		$query = "SELECT middleName FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить логин учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getTeacherFullNameById($id_teacher) {
		$query = "SELECT concat(lastName, ' ', firstName, ' ', middleName) as fio FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить имя учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем телефон учителя по его id
	 * @param id учителя $id_student
	 * @return string
	 */
	public static function getTeacherTelephoneById($id_teacher) {
		$query = "SELECT telephone FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить телефон учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getTeacherEmailById($id_teacher) {
		$query = "SELECT email FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить почту учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getTeacherChairIdByTeacherId($id_teacher) {
		$query = "SELECT id_chair FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить id кафедры учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getTeacherTeachingPositionIdByTeacherId($id_teacher) {
		$query = "SELECT id_teaching_position FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить id препод должности учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getTeacherDegreeIdByTeacherId($id_teacher) {
		$query = "SELECT id_degree FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить телефон учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getTeacherBirthdayById($id_teacher) {
		$query = "SELECT birthday FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить ДР учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getTeacherPhotoById($id_teacher) {
		$query = "SELECT photo FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить фото учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function checkPassword($login, $password) {
		$query = "SELECT login FROM teachers WHERE login like '".$login."' AND password like '".md5($password)."'";
		return (HelpClass::getQuery($query, "Невозможно проверить соответствие пароля и логина учителя", __FUNCTION__)->fetchColumn(0) != "") ? true : false;
	}
	public static function insertTeacher($login, $password, $firstName, $lastName, $middleName, $telephone, $email, $id_chair, $id_teaching_position, $id_degree, $birthday, $photo) {
		$query = "INSERT INTO teachers(login, password, firstName, lastName, middleName, telephone, email, id_chair, id_teaching_position, id_degree, birthday, photo)
					VALUES('".$login."', '".md5($password)."', '".$firstName."', '".$lastName."', '".$middleName."',
							 '".$telephone."', '".$email."', {$id_chair}, {$id_teaching_position}, {$id_degree}, '".$birthday."', '".$photo."')";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
	public static function getTeachersCount() {
		$query = "SELECT count(id_teacher) as count FROM teachers ";
		return HelpClass::getQuery($query, "Невозможно получить количество преподавателей", __FUNCTION__)->fetchColumn(0);
	}
	public static function getTeacherPasswordById($id_teacher) {
		$query = "SELECT password FROM teachers WHERE id_teacher = {$id_teacher}";
		return HelpClass::getQuery($query, "Невозможно получить пароль учителя по его id", __FUNCTION__)->fetchColumn(0);
	}
	
	public static function changePasswordByTeacherId($id_teacher, $password) {
		$query = "UPDATE teachers SET password = '".md5($password)."' WHERE id_teacher = {$id_teacher}";
		return HelpClass::getExec($query, "Невозможно изменить запись", __FUNCTION__);
	}
	public static function changeEmailByTeacherId($id_teacher, $email) {
		$query = "UPDATE teachers SET email = '".$email."' WHERE id_teacher = {$id_teacher}";
		return HelpClass::getExec($query, "Невозможно изменить запись", __FUNCTION__);
	}
	public static function changeTelephoneByTeacherId($id_teacher, $telephone) {
		$query = "UPDATE teachers SET telephone = '".$telephone."' WHERE id_teacher = {$id_teacher}";
		return HelpClass::getExec($query, "Невозможно изменить запись", __FUNCTION__);
	}
	public static function changePhotoByTeacherId($id_teacher, $photo) {
		$query = "UPDATE teachers SET photo = '".$photo."' WHERE id_teacher = {$id_teacher}";
		return HelpClass::getExec($query, "Невозможно изменить запись", __FUNCTION__);
	}
}
?>