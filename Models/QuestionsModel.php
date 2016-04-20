<?php
require_once 'HelpClass.php';

class QuestionsModel {
	public static function getAllQuestionsByPracticeId($id_practice) {
		$query = "SELECT id_question, title, id_practice FROM questions WHERE id_practice = {$id_practice}";
		return HelpClass::getQuery($query, "Невозможно получить все вопросы по id практики", __FUNCTION__);
	}
	
	public static function insertQuestion($title, $id_practice) {
		$query = "INSERT INTO questions(title, id_practice) VALUES('".$title."', {$id_practice})";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
	public static function getQuestionsCountByPracticeId($id_practice) {
		$query = "SELECT count(id_question) as count FROM questions WHERE id_practice = {$id_practice}";
		return HelpClass::getQuery($query, "Невозможно получить", __FUNCTION__)->fetchColumn(0);
	}
}
?>