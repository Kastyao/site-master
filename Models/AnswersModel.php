<?php
require_once 'HelpClass.php';

class AnswersModel {
	public static function getAllAnswersByQuestionId($id_question) {
		$query = "SELECT id_answer, id_question, title, correct FROM answers WHERE id_question = {$id_question}";
		return HelpClass::getQuery($query, "Невозможно получить все ответы по id вопроса", __FUNCTION__);
	}
	
	public static function insertAnswer($id_question, $title, $correct) {
		$query = "INSERT INTO answers(id_question, title, correct) VALUES({$id_question}, '".$title."', {$correct})";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
	public static function checkCorrectAnswer($id_answer) {
		$query = "SELECT correct FROM answers WHERE id_answer = {$id_answer}";
		return (HelpClass::getQuery($query, "Невозможно получить соответствие", __FUNCTION__)->fetchColumn(0) == 1) ? true : false;
	}
	public static function checkManyCorrectAnswers($id_question) {
		$query = "SELECT count(id_question) as c FROM answers WHERE id_question = {$id_question} AND correct = 1";
		return (HelpClass::getQuery($query, "Невозможно получить", __FUNCTION__)->fetchColumn(0) > 1 ) ? true : false;
	}
	public static function getAllCorrectAnswersByQuestionId($id_question) {
		$query = "SELECT id_answer, id_question, title, correct FROM answers WHERE id_question = {$id_question} AND correct = 1";
		return HelpClass::getQuery($query, "Невозможно получить все ответы по id вопроса", __FUNCTION__);
	}
	public static function checkQuestionHaveAnswer($id_answer, $id_question) {
		$query = "SELECT id_answer FROM answers WHERE id_question = {$id_question} AND id_answer = {$id_answer}";
		return (HelpClass::getQuery($query, "Невозможно получить", __FUNCTION__)->fetchColumn(0) != "" ) ? true : false;
	}
	public static function getCorrectCountByQuestionId($id_question) {
		$query = "SELECT count(id_answer) as count FROM answers WHERE id_question = {$id_question} AND correct = 1";
		return HelpClass::getQuery($query, "Невозможно получить", __FUNCTION__)->fetchColumn(0);
	}
} 

?>