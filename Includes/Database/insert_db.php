<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<?php

require_once '../Config/config.php.inc';

class InsertDB {
	private $pdo;
	public function __construct() {
		$this->pdo = Config::getInstance()->getPDO();
	}
	
	public function insertInstitutes() {
		$query = "INSERT INTO institutes(abbr, title)
					VALUES('ИМЭМ', 'Институт математики, экономики и механики'),
						('ИИПО', 'Институт инновационного и последипломного образования'),
						('ИСН', 'Институт социальных наук'),
						('ИМО', 'Институт международного образования');";
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("institutes"));
			else $this->successToInsert("institutes");
	}
	
	public function insertFaculties() {
		$query = "INSERT INTO faculties(abbr, title, id_institute)
					VALUES('ФИТ', 'Факультет информационных технологий', 1),
						('ПМ', 'Факультет прикладной математики', 1);";
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("faculties"));
		else $this->successToInsert("faculties");
	}
	
	public function insertChairs() {
		$query = "INSERT INTO chairs(abbr, title, id_faculty, address, telephone, id_teacher_head)
					VALUES('МОКС', 'Кафедра математического обеспечения компьютерных систем', 1, 'г. Одесса, ул. Дворянская, 2 каб. №38', '63-24-54', 1),
						('ВМ', 'Кафедра вычислительной математики', 1, 'г. Одесса, ул. Дворянская, 2 каб. №109', '63-24-54', 2),
						('ВА', 'Кафедра компьютерной алгебры и дискретной математики', 1, 'г. Одесса, ул. Дворянская, 2 каб. №80', '63-24-54', 3),
						('ДУ', 'Кафедра дифференциальных уравнений', 1, 'г. Одесса, ул. Дворянская, 2 каб. №45', '63-24-54', 5),
						('МА', 'Кафедра математического анализа', 1, 'г. Одесса, ул. Дворянская, 2 каб. №91', '63-24-54', 6);";
		
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("chairs"));
		else $this->successToInsert("chairs");
	}
	
	public function insertDegrees() {
		$query = "INSERT INTO degrees(title)
					VALUES('Кандидат наук'),
						('Доктор наук'),
						('Нет учёной степени');";
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("degrees"));
		else $this->successToInsert("degrees");
	}
	
	public function insertTeachingPositions() {
		$query = "INSERT INTO teaching_positions(title)
					VALUES('Профессор'),
						('Доцент'),
						('Старший преподаватель'),
						('Преподаватель'),
						('Ассистент');";
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("teaching_positions"));
		else $this->successToInsert("teaching_positions");
	}
	
	public function insertTeachers() {
		$query = "INSERT INTO teachers(login, password, firstName, lastName, middleName, telephone, email, id_chair, id_teaching_position, id_degree, birthday, photo)
					VALUES('pti', '".md5("qwerty")."', 'Татьяна', 'Петрушина', 'Ивановна', '+38 (067) 316-21-32', 'pet@i.ua', 1, 1, 1, '1973-02-04', 'no_photo.png'),
						('rvv', '".md5("qwerty")."', 'Виктор', 'Реут', 'Всеволодович', '+38 (050) 316-91-87', 'reut@onu.edu.ua', 2, 1, 1, '1973-02-04', 'reut.jpg'),
						('vpd', '".md5("qwerty")."', 'Павел', 'Варбанец', 'Дмитриевич', '+38 (093) 231-23-21', 'varbanec@onu.edu.ua', 3, 1, 1, '1973-02-04', 'no_photo.png'),
						('lav', '".md5("qwerty")."', 'Людмила', 'Волощук', 'Арнольдовна', '+38 (050) 231-76-83', 'lavstumbre@gmail.com', 1, 2, 1, '1973-02-04', 'voloshuk.jpg');";
	
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("teachers"));
		else $this->successToInsert("teachers");
	}
	
	public function insertStudents() {
		$query = "INSERT INTO students(login, password, firstName, lastName, middleName, telephone, email, id_chair, course, photo)
					VALUES('last', '".md5("qwerty")."', 'Вячеслав', 'Леонов', 'Олегович', '+38 (093) 048-25-46', 'onlylastride@gmail.com', 1, 5, 'no_photo.png'),
							('admin', '".md5("admin")."', 'Иванов', 'Олег', 'Владимирович', '+38 (093) 048-45-26', 'ivanov_oleg@gmail.com', 1, 5, 'no_photo.png');";
	
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("students"));
		else $this->successToInsert("students");
	}
	
	public function insertSubjects() {
		$query = "INSERT INTO subjects(title, id_teacher, id_faculty, id_chair, id_subject_type, course)
					VALUES('Компьютерные сети', 4, 1, 1, 2, 4),
						  ('Компьютерные сети', 4, 1, NULL, 1, 5),
						  ('Защита информации', 4, 1, NULL, 1, 4),
						  ('Базы данных', 1, 1, 1, 2, 5);";
	
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("subjects"));
		else $this->successToInsert("subjects");
	}
	
	public function insertSubjectTypes() {
		$query = "INSERT INTO subject_types(title)
					VALUES('Основной курс'),
						  ('Спец курс');";
	
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("subject_types"));
		else $this->successToInsert("subject_types");
	}
	
	public function insertTime() {
		$query = "INSERT INTO time(title)
					VALUES('8.00 - 9.20'),
							('9.40 - 11.00'),
							('11.10 - 12.30'),
							('12.50 - 14.10'),
							('14.20 - 15.40'),
							('16.00 - 17.20');";
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("subject_types"));
		else $this->successToInsert("time");
		
	}
	
	public function insertWeeks() {
		$query = "INSERT INTO weeks(title)
					VALUES('Понедельник'),
							('Вторник'),
							('Среда'),
							('Четверг'),
							('Пятница');";
		if (! $this->pdo->exec($query)) throw new PDOException($this->unnableToInsert("subject_types"));
		else $this->successToInsert("weeks");
	}
	
	
	private function unnableToInsert($str) {
		return "<p style='color:red'>Невозможно добавить данные в  таблицу {<span style='color:blue'>".$str."</span>}</p>";
	}
	private function successToInsert($str) {
		echo "<div style='color:green'>Данные успешно добавлены в таблицу
				 {<span style='color:blue'>".$str."</span>}</div>";
	}
}

	$insertDB = new InsertDB();
	$insertDB->insertInstitutes();
	$insertDB->insertChairs();
	$insertDB->insertFaculties();
	$insertDB->insertTeachingPositions();
	$insertDB->insertDegrees();
	$insertDB->insertTeachers();
	$insertDB->insertStudents();
	$insertDB->insertSubjects();
	$insertDB->insertSubjectTypes();
	$insertDB->insertTime();
	$insertDB->insertWeeks();
?>
