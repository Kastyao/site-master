<?php
require_once 'HelpClass.php';

class CommentsModel {

	public static function getAllCommentsByLectureId($id_lecture) {
		$query = "SELECT id_comment, content, id_user, id_lecture, role, time FROM comments WHERE id_lecture = {$id_lecture}";
		return HelpClass::getQuery($query, "Невозможно получить все комментарии по id лекции", __FUNCTION__);
	}
	
	public static function insertComment($content, $id_user, $id_lecture, $role) {
		$query = "INSERT INTO comments(content, id_user, id_lecture, role, time) VALUES('".$content."', {$id_user}, {$id_lecture}, '".$role."', '".date("Y-m-d H:i:s")."')";
		return HelpClass::getExec($query, "Невозможно вставить запись", __FUNCTION__);
	}
}

?>