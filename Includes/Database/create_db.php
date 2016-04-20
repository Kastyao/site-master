<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<?php

define('DB_DSN', 'mysql:host=eu-cdbr-azure-north-e.cloudapp.net;');
define('DB_DSN_NEW', 'mysql:host=eu-cdbr-azure-north-e.cloudapp.net;dbname=acsm_fd1933d83373a54');
define('DB_LOGIN', 'bd59f15354d949');
define('DB_PASSWORD', '85459f0d');

class CreateDB {
	private $pdo;
	public function __construct() {
		$this->pdo = new PDO(DB_DSN_NEW, DB_LOGIN, DB_PASSWORD);
	}
	/*public function createDB() {
		$create_db_query = "CREATE DATABASE IF NOT EXISTS acsm_fd1933d83373a54";
		$this->pdo->query($create_db_query);
		$this->pdo = null;
		$this->pdo = new PDO(DB_DSN_NEW, DB_LOGIN, DB_PASSWORD);
	}*/
	public function createStudentsTable() {
		$create_students_query = "CREATE table students 
			(id_student int(8) primary key auto_increment,
				login varchar(40) NOT NULL,
				password varchar(40) NOT NULL,
				firstName varchar(40) NOT NULL,
				lastName varchar(40) NOT NULL,
				middleName varchar(40) NOT NULL,
				telephone varchar(40) NOT NULL,
				email varchar(40) NOT NULL,
				id_chair int(3) NOT NULL,
				course tinyint(1) NOT NULL,
				photo varchar(200) NOT NULL)";
		
		if ($this->pdo->query($create_students_query)) $this->successToCreate("students");
			else throw new PDOException($this->unnableToCreate("students"));
			
	}
	public function createTeachersTable() {
		$create_teachers_query = "CREATE table teachers 
			(id_teacher int(8) primary key auto_increment,
				login varchar(40) NOT NULL,
				password varchar(40) NOT NULL,
				firstName varchar(40) NOT NULL,
				lastName varchar(40) NOT NULL,
				middleName varchar(40) NOT NULL,
				telephone varchar(40) NOT NULL,
				email varchar(40) NOT NULL,
				id_chair int(3) NOT NULL,
				id_teaching_position tinyint(2) NOT NULL,
				id_degree tinyint(2) NOT NULL,
				birthday DATE NOT NULL,
				photo varchar(200) NOT NULL)";
		if ($this->pdo->query($create_teachers_query)) $this->successToCreate("teachers");
			else throw new PDOException($this->unnableToCreate("teachers"));
			
	}
	public function createTeachingPositionsTable() {
		$create_teachingPositions_query = "CREATE table teaching_positions
			(id_teaching_position tinyint(2) primary key auto_increment,
			title varchar(200) NOT NULL)";
		if ($this->pdo->query($create_teachingPositions_query)) $this->successToCreate("teaching_positions");
			else throw new PDOException($this->unnableToCreate("teaching_positions"));
			
	}
	public function createDegreesTable() {
		$create_degrees_query = "CREATE table degrees
				(id_degree tinyint(2) primary key auto_increment,
				title varchar(40) NOT NULL)";
		if ($this->pdo->query($create_degrees_query)) $this->successToCreate("degrees");
			else throw new PDOException($this->unnableToCreate("degrees"));
			
	}
	public function createInstitutesTable() {
		$create_institutes_query = "CREATE table institutes
									(id_institute tinyint(3) primary key auto_increment,
									abbr varchar(40) NOT NULL,
									title varchar(200) NOT NULL)";
	
		if ($this->pdo->query($create_institutes_query)) $this->successToCreate("institutes");
			else throw new PDOException($this->unnableToCreate("institutes"));
	}
	public function createFacultiesTable() {
		$create_faculties_query = "CREATE table faculties
						(id_faculty int(8) primary key auto_increment,
						abbr varchar(40) NOT NULL,
						title varchar(200) NOT NULL,
						id_institute tinyint(3) NOT NULL)";
	
		if ($this->pdo->query($create_faculties_query)) $this->successToCreate("faculties");
			else throw new PDOException($this->unnableToCreate("faculties"));
	}
	public function createChairsTable() {
		$create_chairs_query = "CREATE table chairs
						(id_chair int(8) primary key auto_increment,
						abbr varchar(200) NOT NULL,
						title varchar(200) NOT NULL,
						id_faculty int(8) NOT NULL,
						address varchar(200) NOT NULL,
						telephone varchar(200) NOT NULL,
						id_teacher_head int(8) NOT NULL)";
	
		if ($this->pdo->query($create_chairs_query)) $this->successToCreate("chairs");
			else throw new PDOException($this->unnableToCreate("chairs"));
	}
	public function createSubjectsTable() {
		$create_subjects_query = "CREATE table subjects
						(id_subject int(8) primary key auto_increment,
						title varchar(200) NOT NULL,
						id_teacher int(8) NOT NULL,
						id_faculty int(8) NOT NULL,
						id_chair int(8),
						id_subject_type tinyint(1),
						course tinyint(1) NOT NULL)";
		if ($this->pdo->query($create_subjects_query)) $this->successToCreate("subjects");
			else throw new PDOException($this->unnableToCreate("subjects"));
	}
	public function createSubjectTypesTable() {
		$create_subjectTypes_query = "CREATE table subject_types
						(id_subject_type tinyint(1) primary key auto_increment,
						title varchar(200) NOT NULL)";
		if ($this->pdo->query($create_subjectTypes_query)) $this->successToCreate("subjectTypes");
		else throw new PDOException($this->unnableToCreate("subjectTypes"));
	}
	public function createLecturesTable() {
		$create_lectures_query = "CREATE table lectures
						(id_lecture int(8) primary key auto_increment,
						title varchar(200) NOT NULL,
						number tinyint(1) NOT NULL,
						content text NOT NULL,
						id_subject int(8) NOT NULL)";
		if ($this->pdo->query($create_lectures_query)) $this->successToCreate("lectures");
			else throw new PDOException($this->unnableToCreate("lectures"));
	}
	public function createCommentsTable() {
		$create_comments_query = "CREATE table comments
						(id_comment int(8) primary key auto_increment,
						content text NOT NULL,
						id_user int(8) NOT NULL,
					id_lecture int(8) NOT NULL,
						role varchar(200) NOT NULL,
						time DATETIME NOT NULL)";
		if ($this->pdo->query($create_comments_query)) $this->successToCreate("comments");
		else throw new PDOException($this->unnableToCreate("comments"));
	}
	public function createTimeTable() {
		$create_time_query = "CREATE table time
		(id_time int(8) primary key auto_increment,
		title varchar(200) NOT NULL)";
		if ($this->pdo->query($create_time_query)) $this->successToCreate("time");
		else throw new PDOException($this->unnableToCreate("time"));
	}
	public function createWeeksTable() {
		$create_week_query = "CREATE table weeks
		(id_week int(8) primary key auto_increment,
		title varchar(200) NOT NULL)";
		if ($this->pdo->query($create_week_query)) $this->successToCreate("week");
		else throw new PDOException($this->unnableToCreate("week"));
	}
	public function createScheduleTable() {
		$create_schedule_query = "CREATE table schedule
						(id_schedule int(8) primary key auto_increment,
						id_time int(8) NOT NULL,
						id_week int(8) NOT NULL,
						id_teacher int(8) NOT NULL,
						id_subject int(8) NOT NULL,
						cabinet tinyint(3) NOT NULL)";
		if ($this->pdo->query($create_schedule_query)) $this->successToCreate("schedule");
		else throw new PDOException($this->unnableToCreate("schedule"));
	}
	public function createPracticeTable() {
		$create_practice_query = "CREATE table practice
						(id_practice int(8) primary key auto_increment,
						title varchar(200) NOT NULL,
						id_lecture int(8) NOT NULL)";
		if ($this->pdo->query($create_practice_query)) $this->successToCreate("practice");
		else throw new PDOException($this->unnableToCreate("practice"));
	}
	public function createQuestionsTable() {
		$create_questions_query = "CREATE table questions
						(id_question int(8) primary key auto_increment,
						title varchar(200) NOT NULL,
						id_practice int(8) NOT NULL)";
		if ($this->pdo->query($create_questions_query)) $this->successToCreate("questions");
		else throw new PDOException($this->unnableToCreate("questions"));
	}
	public function createAnswersTable() {
		$create_answers_query = "CREATE table answers
						(id_answer int(8) primary key auto_increment,
						id_question int(8) NOT NULL,
						title varchar(200) NOT NULL,
						correct tinyint(1) NOT NULL)";
		if ($this->pdo->query($create_answers_query)) $this->successToCreate("answers");
		else throw new PDOException($this->unnableToCreate("answers"));
	}
	private function unnableToCreate($str) {
		return "<p style='color:red'>Невозможно создать таблицу {<span style='color:blue'>".$str."</span>}</p>";
	}
	private function successToCreate($str) {
		echo "<div style='color:green'>Таблица {<span style='color:blue'>".$str."</span>} успешно создана</div>";
	}
}
	$createDB = new CreateDB();
	
//	$createDB->createDB();
	$createDB->createStudentsTable();

	$createDB->createDegreesTable();
	$createDB->createFacultiesTable();
	$createDB->createInstitutesTable();
	$createDB->createLecturesTable();
	$createDB->createSubjectsTable();
	$createDB->createSubjectTypesTable();
	$createDB->createTeachersTable();
	$createDB->createTeachingPositionsTable();
	$createDB->createChairsTable();
	$createDB->createCommentsTable();
	$createDB->createTimeTable();
	$createDB->createWeeksTable();
	$createDB->createScheduleTable();
	$createDB->createAnswersTable();
	$createDB->createPracticeTable();
	$createDB->createQuestionsTable();
?>
