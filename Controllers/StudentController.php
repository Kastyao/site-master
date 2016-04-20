<?php
require_once '../Includes/Scripts/autoload.php';


class StudentController {
	private $IMAGE_FOLDER = '../Includes/Images/';
	private $TEACHERS_IMAGE_FOLDER = '../Includes/Images/Teachers/';
	private $STUDENTS_IMAGE_FOLDER = '../Includes/Images/Students/';

	public function checkContent() {
		$action = $_GET['action'];
		switch ($action) {
			case "": $this->getIndexContent();
							break;
			case "profile": $this->getProfileContent();
							break;
			case "subjects": $this->getSubjectsContent();
							break;
			case "teachers" : $this->getTeachersContent();
							break;
			case "showTest" : $this->getShowTestContent();
							break;
			case "showTestResults" : $this->getShowTestResultsContent();
							break;
		}
	}

	public function getIndexContent() {
		echo "student";
	}

public function getShowTestContent() {
		$id_practice = $_GET['id_practice'];
		echo "<center><h2 class='orange'>Лекция № ".LecturesModel::getLectureNumberById(PracticeModel::getLectureIdByPracticeId($id_practice)).". ".LecturesModel::getLectureTitleById(PracticeModel::getLectureIdByPracticeId($id_practice))."
				<br><span class='blue'>Тест - <u>".PracticeModel::getPracticeTitleById($id_practice)."</u></span></h2></center>";
		$i = 0;
		echo "<form method='POST' action='StudentView.php?action=showTestResults&id_practice={$id_practice}'>";
		foreach (QuestionsModel::getAllQuestionsByPracticeId($id_practice) as $row_questions) {
			$i++;
			echo "<center><h3>Вопрос № ".$i."</h3><table border='1' style='width:80%'><thead><tr><th colspan='2'>Вопрос</th></tr></thead><tbody>
	  		<tr>
	  			<td colspan='2' class='light bold'>
					".$row_questions['title']."
	  			</td>
			</tr>
			</tbody>
	  		<thead><tr><th colspan='2'>Варианты ответов</th></tr></thead><tbody>";
			$j = 0;
			foreach (AnswersModel::getAllAnswersByQuestionId($row_questions['id_question']) as $row_answers) {
				$j ++;
				echo "<tr>
						<td width='30px;' >";
				if (AnswersModel::checkManyCorrectAnswers($row_questions['id_question'])) {
				echo "<input type='checkbox' style='height:20px;' name='answers[]' value='{$row_answers['id_answer']}'>";
				} else {
					echo "<input type='radio' style='height:20px;' name='answers[]' value='{$row_answers['id_answer']}'>";
				}
					echo "</td>
				<td>
											<span class='bold'>".$j.".</span> ".$row_answers['title']."
			
				</td>
				
				</tr>";
			}
				
			echo "</table></center><hr>";
			
		}
		echo "<br><center><input type='submit' class='button gradient small orange'  value='Проверить'></center></form>";
	}
	
	public function getShowTestResultsContent() {
		$id_practice = $_GET['id_practice'];
		$answers_array = $_POST['answers'];
		$count = 0; $correct_answer = 0;
		echo "<h2>Результаты теста</h2>";
		foreach (QuestionsModel::getAllQuestionsByPracticeId($id_practice) as $row_questions) {
			$ans_count = 0;
			foreach (AnswersModel::getAllCorrectAnswersByQuestionId($row_questions['id_question']) as $row_correct_answers) {
				if (in_array($row_correct_answers['id_answer'], $answers_array)) {
					$ans_count ++;
				}
			}
			if ($ans_count == AnswersModel::getCorrectCountByQuestionId($row_questions['id_question']))	{
				$correct_answer ++;
			}
			$ans_count = 0;
		}
		
		$mark = QuestionsModel::getQuestionsCountByPracticeId($id_practice) - $correct_answer;
		if ($mark == 0) {
			$mark = 100;
		} else {
			$mark = round((100 / QuestionsModel::getQuestionsCountByPracticeId($id_practice)) * $correct_answer);
		}
		
		echo "<center><h2 class='orange'>Ваш результат : ".$correct_answer." из ".QuestionsModel::getQuestionsCountByPracticeId($id_practice)."</h2></center>
			<center><h2 class='orange'>Ваша оценка : ".$mark." б.</h2></center>";
		
		echo "<form>";
		
		
	foreach (QuestionsModel::getAllQuestionsByPracticeId($id_practice) as $row_questions) {
			$count++;
			$ans_count = 0;
			foreach (AnswersModel::getAllCorrectAnswersByQuestionId($row_questions['id_question']) as $row_correct_answers) {
				if (in_array($row_correct_answers['id_answer'], $answers_array)) {
					$ans_count ++;
				}
			}
			if ($ans_count == AnswersModel::getCorrectCountByQuestionId($row_questions['id_question']))	{
				echo "<div class='row8'><span class='icon-ok icon-2x green'></span>";
			} else {
				echo "<div class='row7'><span class='icon-remove icon-2x red'></span>";
			}
			
			echo "<center><h3>Вопрос № ".$count."</h3><table border='1' style='width:80%'><thead><tr><th colspan='2'>Вопрос</th></tr></thead><tbody>
	  		<tr>
	  			<td colspan='2' class='light bold'>
					".$row_questions['title']."
	  			</td>
			</tr>
			</tbody>
	  		<thead><tr><th colspan='2'>Варианты ответов</th></tr></thead><tbody>";
			$j = 0;
			foreach (AnswersModel::getAllAnswersByQuestionId($row_questions['id_question']) as $row_answers) {
				$j ++;
				echo "<tr>
						<td width='30px;' >";
				if (AnswersModel::checkManyCorrectAnswers($row_questions['id_question'])) {
					for ($i = 0; $i < count($answers_array); $i ++) {
						if ($row_answers['id_answer'] == $answers_array[$i]) {
							$checked = "checked";
							break;
						} else {
							$checked = "";
						}
					}
					echo "<input type='checkbox' style='height:20px;' name='answers[]' value='{$row_answers['id_answer']}' ".$checked." disabled>";
				} else {
					for ($i = 0; $i < count($answers_array); $i ++) {
						if ($row_answers['id_answer'] == $answers_array[$i]) {
							$checked = "checked";
							break;
						} else {
							$checked = "";
						}
					}
					echo "<input type='radio' style='height:20px;' name='answers[]' value='{$row_answers['id_answer']}' ".$checked." disabled>";
				}
					echo "</td>
				<td>";
					if (AnswersModel::checkCorrectAnswer($row_answers['id_answer'])) {
						echo "<span class='icon-ok icon-large green' style='position:absolute;'></span>";
					} 
					echo "<span style='margin-left: 30px; '><span class='bold'>".$j.".</span> ".$row_answers['title']."</span>
			
				</td>
				
				</tr>";
			}
				
			echo "</table></center></div><hr>";
			
		}
		
	}
	
	public function getSubjectsContent() {
		echo "<h2>Предметы</h2>";
		if ($success != "") {
			echo "<div class='alert-msg rnd8 success'>".$success."<a class='close'' href='#'>X</a></div>";
		}
		foreach (SubjectTypesModel::getAllSubjectTypes() as $row_subject_types) {
			echo "
			<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_subject_types['title']."</span></a>
			<div class='toggle-content'>";
		/*	foreach (SubjectsModel::getAllSubjectsCoursesByTeacherIdAndSubjectTypeId($_SESSION['id_user'], $row_subject_types['id_subject_type']) as $row_course) {
				echo "<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_course['course']." курс</span></a>
				<div class='toggle-content'>"; */
				foreach (SubjectsModel::getAllSubjectsByChairOrFacultyIdCourseAndSubjectTypeId(
						StudentsModel::getStudentChairIdByStudentId($_SESSION['id_user']), 
						ChairsModel::getFacultyIdByChairId(StudentsModel::getStudentChairIdByStudentId($_SESSION['id_user'])),
						StudentsModel::getStudentCourseIdById($_SESSION['id_user']),
						$row_subject_types['id_subject_type']) as $row_subjects) {
					$i ++;
					echo "<table>";
					echo "<thead>
							<tr>
							<th width='5px;'>№</th>
							<th>Название</th><th>Преподаватель</th>";
					echo "<th>Список лекций</th>
							<th width='150px;'>Список тестов</th></thead>
					<tbody>";
					echo "<tr class='light bold'>
					<td>{$i}</td>
					<td>".$row_subjects['title']."</td>
							<td>".TeachersModel::getTeacherFullNameById($row_subjects['id_teacher'])."</td>";
					echo "<td>";
					foreach (LecturesModel::getAllLecturesBySubjectId($row_subjects['id_subject']) as $row_lectures) {
						echo "<a class='blue' href='LectureView.php?action=showLecture&id={$row_lectures['id_lecture']}'>".$row_lectures['number'].".&nbsp;".$row_lectures['title']."</a>&nbsp;
							<a class='orange' href = 'LectureView.php?action=showLecture&id={$row_lectures['id_lecture']}&option=export' title='Экспорт в pdf'><span class='icon-save'></span></a>&nbsp;
							<br>";
					}
					echo "</td>
						<td>";
						foreach (LecturesModel::getAllLecturesBySubjectId($row_subjects['id_subject']) as $row_lectures) {
							foreach (PracticeModel::getAllPracticeByLectureId($row_lectures['id_lecture']) as $row_practice) {
								echo "<a class='blue' href='StudentView.php?action=showTest&id_practice={$row_practice['id_practice']}'><span class='orange'>Лекция № ".LecturesModel::getLectureNumberById($row_practice['id_lecture']).".</span>&nbsp;".$row_practice['title']."</a>&nbsp;
								<br>";
							}
						}
					echo "</td>
					</tr>";
					echo "</tbody></table>";
				}
				$i = 0;
				echo "</div>";
			}
			echo "</div></div>";
	}

	public function getTeachersContent() {
		echo "<h2>Преподаватели</h2>";
		foreach (ChairsModel::getAllChairs() as $row_chairs) {
				
			echo "<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_chairs['title']."</span></a>
						<div class='toggle-content'>";
			foreach (TeachersModel::getAllTeachersByChairId($row_chairs['id_chair']) as $row_teachers) {
				$i++;
				echo "<p><img class='boxholder' style='margin-right:20px;float:left;width:150px;height:150px;' src='".$this->TEACHERS_IMAGE_FOLDER.$row_teachers['photo']."'><br>
							<b>ФИО: <a>".$row_teachers['fullName']."</a></b><br>
							<b>Логин</b>: ".$row_teachers['login']."<br>
							<b>Телефон</b>: ".$row_teachers['telephone']."<br>
							<b>Почта</b>: <a href='".$row_teachers['email']."'>".$row_teachers['email']."</a><br>
							<b>Преподовательская должность</b>: ".TeachingPositionsModel::getTeachingPositionTitleById($row_teachers['id_teaching_position'])."";
							if (ChairsModel::getTeacherHeadIdByChairId($row_chairs['id_chair']) == $row_teachers['id_teacher']) {
								echo ", <span class='red'>заведующий кафедрой</span>";
							}								
				echo"<br>
							<b>Учёная степень</b>: ".DegreesModel::getDegreeTitleById($row_teachers['id_degree'])."<br>
							<b>Дата рождения</b>:".$row_teachers['birthday']."<br><br>";
							
				echo "<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>Расписание</span></a>
						<div class='toggle-content'>";
				
				foreach (WeeksModel::getAllWeeks() as $row_weeks) {
					if (ScheduleModel::checkWeekId($row_weeks['id_week'], $row_teachers['id_teacher'])) {
						echo "
								<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_weeks['title']."</span></a>
						<div class='toggle-content'>";
						echo "<table style='width:100%'>
							<thead>
								<tr>
									<th style='width:50px;'>№ пары</th>
									<th style='width:90px;'>Время</th>
									<th>Предмет</th>
									<th>Фак-т / Каф-а</th>
									<th>Курс</th>
									<th style='width:10px;'>Кабинет</th>
								</tr>
							</thead>
							<tbody>";
						foreach (ScheduleModel::getScheduleByTeacherAndWeekId($row_teachers['id_teacher'], $row_weeks['id_week']) as $row_schedule) {
							echo "<tr class='light bold'>
								<td>".$row_schedule['id_time']." пара</td>
								<td>".TimeModel::getTimeTitleById($row_schedule['id_time'])."</td>
								<td>".SubjectsModel::getSubjectTitleById($row_schedule['id_subject'])."</td>";
							if (SubjectsModel::getSubjectTypeIdById($row_schedule['id_subject']) == 1) {
								echo "<td>".FacultiesModel::getFacultyAbbrById(SubjectsModel::getSubjectFacultyIdById($row_schedule['id_subject']))."</td>";
							} else {
								echo "<td>".FacultiesModel::getFacultyAbbrById(SubjectsModel::getSubjectFacultyIdById($row_schedule['id_subject']))." / ".ChairsModel::getChairAbbrById(SubjectsModel::getSubjectChairIdById($row_schedule['id_subject']))."</td>";
				
							}
							echo "<td>".SubjectsModel::getSubjectCourseById($row_schedule['id_subject'])."</td><td>".$row_schedule['cabinet']."</td>
							</tr>";
						}
						echo "</tbody></table></div></div>";
					}
				}
				echo "</div></div>";
							
			}
			$i = 0;
			echo "</p></div>";
				
		}
	}
	
	public function getProfileContent() {
		$newPassword = $_POST['newPassword'];
		$telephone = $_POST['newTelephone'];
		$email = $_POST['newEmail'];

		$photo = basename($_FILES['newPhoto']['name']);
		$uploadfile = $this->STUDENTS_IMAGE_FOLDER . basename($_FILES['newPhoto']['name']);
		move_uploaded_file($_FILES['newPhoto']['tmp_name'], $uploadfile);


		if ($newPassword != "") {
			StudentsModel::changePasswordByStudentId($_SESSION['id_user'], $newPassword);
			$success = "Профиль успешно изменён !";
		}
		if ($telephone != "") {
			StudentsModel::changeTelephoneByStudentId($_SESSION['id_user'], $telephone);
			$success = "Профиль успешно изменён !";
		}
		if ($email != "") {
			StudentsModel::changeEmailByStudentId($_SESSION['id_user'], $email);
			$success = "Профиль успешно изменён !";
		}
		if ($photo != "") {
			StudentsModel::changePhotoByStudentId($_SESSION['id_user'], $photo);
			$success = "Профиль успешно изменён !";
		}
		echo "<h2>Мой профиль</h2>";
		if ($success != "") {
			echo "<div class='alert-msg rnd8 success'>".$success."<a class='close'' href='#'>X</a></div>";
		}
		echo "<div class='tab-wrapper rnd10 clear'>
		<ul class='tab-nav clear'>
		<li><a class='blue' href='#tab-1'>Просмотр</a></li>
		<li><a class='blue' href='#tab-2'>Изменение</a></li>
		</ul>
		<div class='tab-container'>
		<div id='tab-1' class='tab-content clear'>";
		foreach (StudentsModel::getStudentById($_SESSION['id_user']) as $row_student) {
			echo "<div class='two_half'>";
			echo "<img class='boxholder' style='margin-right:20px;float:left;width:200px;height:200px;' src='".$this->STUDENTS_IMAGE_FOLDER.$row_student['photo']."'><br>
			<b>ФИО: <a>".$row_student['fullName']."</a></b><br>
			<b>Логин</b>: ".$row_student['login']."<br>
			<b>Телефон</b>: ".$row_student['telephone']."<br>
			<b>Почта</b>: <a href='".$row_student['email']."'>".$row_student['email']."</a><br>
			<b>Кафедра</b>: ".ChairsModel::getChairTitleById($row_student['id_chair'])."<br>
			<b>Курс</b>: ".$row_student['course']."<br><br><br>";
			echo "</div>";
		}
		echo "</div>
		<div id='tab-2' class='tab-content clear'>";

		echo "";
		echo "<form method='POST' enctype='multipart/form-data' class='rnd5' action='StudentView.php?action=profile'>
		<div class='one_third'>
		<p class='bold'>Изменение пароля</p><br>
		<label for='oldPassword'>Старый пароль</label>
		<input type='password' style='width:200px;' name='oldPassword'>
		<label for='newPassword'>Новый пароль</label>
		<input type='password' style='width:200px;' name='newPassword'>
		<label for='newPasswordRepeat'>Повторите новый пароль</label>
		<input type='password' style='width:200px;' name='newPasswordRepeat'>
		</div>
		<div class='one_third'>
		<p class='bold'>Изменение личных данных</p><br>
		<label for='newTelephone'>Изменить телефон</label>
		<input type='text' style='width:200px;' name='newTelephone'>
		<label for='newEmail'>Изменить почту</label>
		<input type='text' style='width:200px;' name='newEmail'>
		<label for='newPhoto'>Фотография</label>
		<input type='file' name='newPhoto'><br><br>
		<input type='submit' class='button gradient small orange' value='Изменить'>
		</form>
		</div>";
		echo "</div></div>";
	}
}
?>