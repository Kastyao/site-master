<?php
require_once 'HelpClass.php';

class StudentsModel {
	/**
	 * Получаем всех студентов
	 * @return PDOStatement
	 */
	public static function getAllStudents() {
		$query = "SELECT id_student, login, password, firstName, lastName, middleName, telephone, email,
						id_chair, course, photo FROM students";
		return HelpClass::getQuery($query, "Невозможно получить всех студентов", __FUNCTION__);
	}
	public static function getAllStudentsByChairId($id_chair) {
		$query = "SELECT id_student, login, password, firstName, lastName, middleName, concat(lastName, ' ', firstName, ' ', middleName) as fullName, telephone, email,
		id_chair, course, photo FROM students WHERE id_chair = {$id_chair}";
		return HelpClass::getQuery($query, "Невозможно получить всех студентов по id кафедры", __FUNCTION__);
	}
	public static function getAllStudentsByCourseAndChairId($course, $id_chair) {
		$query = "SELECT id_student, login, password, firstName, lastName, middleName, concat(lastName, ' ', firstName, ' ', middleName) as fullName, telephone, email,
		id_chair, course, photo FROM students WHERE id_chair = {$id_chair} AND course = {$course}";
		return HelpClass::getQuery($query, "Невозможно получить всех студентов по id кафедры", __FUNCTION__);
	}
	public static function getStudentFullNameById($id_student) {
		$query = "SELECT concat(lastName, ' ', firstName, ' ', middleName) as fullName FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить имя студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getStudentById($id_student) {
		$query = "SELECT concat(lastName, ' ', firstName, ' ', middleName) as fullName, id_student, login, password, firstName, lastName, middleName, telephone, email,
		id_chair, course, photo FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить всех студентов", __FUNCTION__);
	}
	/**
	 * Получаем логин студента по его id
	 * @param id студента $id_student
	 * @return string
	 */
	public static function getStudentLoginById($id_student) {
		$query = "SELECT login FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить логин студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	public static function getStudentPasswordById($id_student) {
		$query = "SELECT password FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить пароль студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем id студента по его логину
	 * @param логин студента $id_student
	 * @return string
	 */
	public static function getStudentIdByLogin($login) {
		$query = "SELECT id_student FROM students WHERE login like '".$login."'";
		return HelpClass::getQuery($query, "Невозможно получить id студента по его логину", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем имя студента по его id
	 * @param id студента $id_student
	 * @return string
	 */
	public static function getStudentFirstNameById($id_student) {
		$query = "SELECT firstName FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить имя студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	
	/**
	 * Получаем фамилию студента по его id
	 * @param id студента $id_student
	 * @return string
	 */
	public static function getStudentLastNameById($id_student) {
		$query = "SELECT lastName FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить фамилию студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	
	/**
	 * Получаем отчество студента по его id
	 * @param id студента $id_student
	 * @return string
	 */
	public static function getStudentMiddleNameById($id_student) {
		$query = "SELECT middleName FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить отчество студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	
	/**
	 * Получаем телефон студента по его id
	 * @param id студента $id_student
	 * @return string
	 */
	public static function getStudentTelephoneById($id_student) {
		$query = "SELECT telephone FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить телефон студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем почту студента по его id
	 * @param id студента $id_student
	 * @return string
	 */
	public static function getStudentEmailById($id_student) {
		$query = "SELECT email FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить почту студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	
	/**
	 * Получаем id кафедры студента по его id
	 * @param id студента $id_student
	 * @return string
	 */
	public static function getStudentChairIdByStudentId($id_student) {
		$query = "SELECT id_chair FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить id кафедры студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем курс студента по его id
	 * @param id студента $id_student
	 * @return string
	 */
	public static function getStudentCourseIdById($id_student) {
		$query = "SELECT course FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить курс студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Получаем фото студента по его id
	 * @param id студента $id_student
	 * @return string
	 */
	public static function getStudentPhotoById($id_student) {
		$query = "SELECT photo FROM students WHERE id_student = {$id_student}";
		return HelpClass::getQuery($query, "Невозможно получить фото студента по его id", __FUNCTION__)->fetchColumn(0);
	}
	/**
	 * Проверяем соответствие логина и пароля студента
	 * @param логин $login
	 * @param пароль $password
	 * @return boolean
	 */
	public static function checkPassword($login, $password) {
		$query = "SELECT login FROM students WHERE login like '".$login."' AND password like '".md5($password)."'";
		return (HelpClass::getQuery($query, "Невозможно проверить соответствие пароля и логина студента", __FUNCTION__)->fetchColumn(0) != "") ? true : false; 
	}
	public static function insertStudent($login, $password, $firstName, $lastName, $middleName, $telephone, $email, $id_chair, $course, $photo) {
		$query = "INSERT INTO students(login, password, firstName, lastName, middleName, telephone, email, id_chair, course, photo)
		VALUES('".$login."', '".md5($password)."', '".$firstName."', '".$lastName."', '".$middleName."',
		'".$telephone."', '".$email."', {$id_chair}, {$course}, '".$photo."')";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
	
	public static function getStudentsCount() {
		$query = "SELECT count(id_student) as count FROM students ";
		return HelpClass::getQuery($query, "Невозможно получить количество студентов", __FUNCTION__)->fetchColumn(0);
	}
	
	public static function changePasswordByStudentId($id_student, $password) {
		$query = "UPDATE students SET password = '".md5($password)."' WHERE id_student = {$id_student}";
		return HelpClass::getExec($query, "Невозможно изменить запись", __FUNCTION__);
	}
	public static function changeEmailByStudentId($id_student, $email) {
		$query = "UPDATE students SET email = '".$email."' WHERE id_student = {$id_student}";
		return HelpClass::getExec($query, "Невозможно изменить запись", __FUNCTION__);
	}
	public static function changeTelephoneByStudentId($id_student, $telephone) {
		$query = "UPDATE students SET telephone = '".$telephone."' WHERE id_student = {$id_student}";
		return HelpClass::getExec($query, "Невозможно изменить запись", __FUNCTION__);
	}
	public static function changePhotoByStudentId($id_student, $photo) {
		$query = "UPDATE students SET photo = '".$photo."' WHERE id_student = {$id_student}";
		return HelpClass::getExec($query, "Невозможно изменить запись", __FUNCTION__);
	}
}

?>