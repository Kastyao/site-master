<?php
require_once '../Includes/Scripts/autoload.php';

class TeacherController {
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
			case "students": $this->getStudentsContent();
					break;
			case "addLecture": $this->getAddLectureContent();
					break;
			case "showLecture": $this->getShowLectureContent();
					break;
			case "editLecture": $this->getEditLectureContent();
					break;
			case "schedule": $this->getScheduleContent();
					break;
			case "test": $this->getTestContent();
					break;
			case "showTest": $this->getShowTestContent();
					break;
		}
	}
	
	public function getIndexContent() {
		echo "asd";
	}
	
	public function getProfileContent() {
		$newPassword = $_POST['newPassword'];
		$telephone = $_POST['newTelephone'];
		$email = $_POST['newEmail'];
		
		$photo = basename($_FILES['newPhoto']['name']);
		$uploadfile = $this->STUDENTS_IMAGE_FOLDER . basename($_FILES['newPhoto']['name']);
		move_uploaded_file($_FILES['newPhoto']['tmp_name'], $uploadfile);
		
		
		if ($newPassword != "") {
			TeachersModel::changePasswordByTeacherId($_SESSION['id_user'], $newPassword);
			$success = "Профиль успешно изменён !";
		}
		if ($telephone != "") {
			TeachersModel::changeTelephoneByTeacherId($_SESSION['id_user'], $telephone);
			$success = "Профиль успешно изменён !";
		}
		if ($email != "") {
			TeachersModel::changeEmailByTeacherId($_SESSION['id_user'], $email);
			$success = "Профиль успешно изменён !";
		}
		if ($photo != "") {
			TeachersModel::changePhotoByTeacherId($_SESSION['id_user'], $photo);
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
		foreach (TeachersModel::getTeacherById($_SESSION['id_user']) as $row_teacher) {
			echo "<div class='two_half'>";
				echo "<img class='boxholder' style='margin-right:20px;float:left;width:200px;height:200px;' src='".$this->TEACHERS_IMAGE_FOLDER.$row_teacher['photo']."'><br>
							<b>ФИО: <a>".$row_teacher['fullName']."</a></b><br>
							<b>Логин</b>: ".$row_teacher['login']."<br>
							<b>Телефон</b>: ".$row_teacher['telephone']."<br>
							<b>Почта</b>: <a href='".$row_teacher['email']."'>".$row_teacher['email']."</a><br>
							<b>Кафедра</b>: ".ChairsModel::getChairTitleById($row_teacher['id_chair'])."<br>
							<b>Преподовательская должность</b>: ".TeachingPositionsModel::getTeachingPositionTitleById($row_teacher['id_teaching_position'])."<br>
							<b>Учёная степень</b>: ".DegreesModel::getDegreeTitleById($row_teacher['id_degree'])."<br>
							<b>Дата рождения</b>:".$row_teacher['birthday']."<br><br><br>
							";
			echo "</div>";
		} 
		echo "</div>
				<div id='tab-2' class='tab-content clear'>";
				
		echo "";
		echo "<form method='POST' enctype='multipart/form-data' class='rnd5' action='TeacherView.php?action=profile'>
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
	
	public function getTestContent() {
		$id_subject = $_GET['id'];
		echo "<h2>Тест</h2>";
		echo "<form method='POST' id='test_form' action='TeacherView.php?action=subjects'>
			<center>Название теста<input style='width:40%;' type='text' name='test_title'>
			Выберите лекцию <br><select style='width:40%;height:25px;' name='test_id_lecture'>";
			foreach (LecturesModel::getAllLecturesBySubjectId($id_subject) as $row_lectures) {
					echo "<option value='".$row_lectures['id_lecture']."'>".$row_lectures['number'].". ".$row_lectures['title']."</option>";	
			}
		echo "</select>
			</center><br>
			<div id='question_add'></div>	<br>	
			<a class='orange' id='question_add_click' style='cursor:pointer'><span class=' icon-plus-sign'></span> Добавить вопрос</a>
			<center><input type='submit' class='button gradient small orange'  value='Сохранить тест'></center></form>";
	}
	public function getShowTestContent() {
		$id_practice = $_GET['id_practice'];
		echo "<center><h2 class='orange'>Лекция № ".LecturesModel::getLectureNumberById(PracticeModel::getLectureIdByPracticeId($id_practice)).". ".LecturesModel::getLectureTitleById(PracticeModel::getLectureIdByPracticeId($id_practice))."
				<br>Тест - ".PracticeModel::getPracticeTitleById($id_practice)."</h2></center>";
		$i = 0;
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
				<td>
											<span class='bold'>".$j.".</span> ".$row_answers['title']."
						
				</td>
				<td width='20px;' >";
				if ($row_answers['correct'] == 1) {
					echo "<span class='icon-ok icon-large green'></span>";
				} else {
					echo "<span class='icon-remove icon-large red'></span>";
						
				}
				echo "</td>
				</tr>";
			}
	  		
	  		echo "</table></center><hr>";
		}
	}
	
	public function getSubjectsContent() {
		$title = $_POST['title'];
		$number = $_POST['number'];
		$content = $_POST['content'];
		$id_subject = $_POST['id_subject'];
		$id_lecture = $_POST['id_lecture'];
		$id_lecture = $_GET['id_lecture'];
		$option = $_GET['option'];
		if ($option == "export") {
			$this->exportToPDF(LecturesModel::getLectureContentById($id_lecture));
		}
		if ($title != "" && ! isset($id_lecture) && !isset($option)) {
			LecturesModel::insertLecture($title, $number, $content, $id_subject);
			$success = "Лекция успешно добавлена !";
		} else {
			if (isset($id_lecture) && !isset($option)) {
				LecturesModel::updateLecture($id_lecture, $title, $number, $content);
				$success = "Лекция успешно изменена !";
				
			}
		} 
		if ($option == "delete") {
			LecturesModel::deleteLecture($id_lecture);
			$success = "Лекция успешно удалена !";
		}
		/**
		 * Добавление нового теста
		 */
		$test_title = $_POST['test_title'];
		$test_id_lecture = $_POST['test_id_lecture'];
		$questions_array = $_POST['title_content'];
		$answers_array = $_POST['answer'];
		$correct_answer_array = $_POST['correct_answer'];
		$questions_number = $_POST['question_number'];

		if (isset($test_title)) {
			PracticeModel::insertPractice($test_title, $test_id_lecture);
			$id_practice = HelpClass::getLastInsertedId();
			$j = 0;
			foreach ($questions_array as $key=>$value_question) {
				QuestionsModel::insertQuestion($value_question, $id_practice);
				$id_question = HelpClass::getLastInsertedId();
				foreach ($answers_array[$key+1] as $key_answer=>$value_answer) {
					if ($correct_answer_array[$j] == 1) {
						AnswersModel::insertAnswer($id_question, $value_answer, 1);
					}	else {
						AnswersModel::insertAnswer($id_question, $value_answer, 0);
					}
					$j++;
				}
			}
			if ($j > 0) {
				$success = "Тест успешно добавлен !";
			}
			}
		/**
		 * Конец добавление нового теста
		 */
		
		echo "<h2>Предметы</h2>";
		if ($success != "") {
			echo "<div class='alert-msg rnd8 success'>".$success."<a class='close'' href='#'>X</a></div>";
		}
		foreach (SubjectTypesModel::getAllSubjectTypes() as $row_subject_types) {
			echo "
			<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_subject_types['title']."</span></a>
			<div class='toggle-content'>";
			foreach (SubjectsModel::getAllSubjectsCoursesByTeacherIdAndSubjectTypeId($_SESSION['id_user'], $row_subject_types['id_subject_type']) as $row_course) {
				echo "<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_course['course']." курс</span></a>
					<div class='toggle-content'>";
				foreach (SubjectsModel::getAllSubjectsByTeacherIdCourseAndSubjectTypeId($_SESSION['id_user'], 
								$row_course['course'], $row_subject_types['id_subject_type']) as $row_subjects) {
					$i ++;
					echo "<table>";
					echo "<thead><tr><th width='5px;'>№</th><th>Название</th>";
					if ($row_subject_types['id_subject_type'] == 1) { 
						echo "<th>Фак-т</th>";
					} else {
						echo "<th>Кафедра</th>";
					}
					echo "<th>Список лекций</th>
							<th>Список тестов</th></thead>
				<tbody>";
					echo "<tr class='light bold'>
							<td>{$i}</td>
							<td>".$row_subjects['title']."</td>";
					if ($row_subject_types['id_subject_type'] == 1) { 
						echo "<td>".FacultiesModel::getFacultyAbbrById($row_subjects['id_faculty'])."</td>";
					} else {
						echo "<td>".ChairsModel::getChairAbbrById($row_subjects['id_chair'])."</td>";
					}
					echo "<td>";
					foreach (LecturesModel::getAllLecturesBySubjectId($row_subjects['id_subject']) as $row_lectures) {
						echo "<a class='blue' href='LectureView.php?action=showLecture&id={$row_lectures['id_lecture']}'>".$row_lectures['number'].".&nbsp;".$row_lectures['title']."</a>&nbsp;
								<a style='color:orange' href='LectureView.php?action=editLecture&id=".$row_lectures['id_lecture']."' title='Изменить'><span class='icon-pencil'></span></a>
								<a style='color:blue' href = 'LectureView.php?action=showLecture&id={$row_lectures['id_lecture']}&option=export' title='Экспорт в pdf'><span class='icon-save'></span></a>&nbsp;
								<a style='color:red' href='TeacherView.php?action=subjects&option=delete&id_lecture=".$row_lectures['id_lecture']."' title='Удалить'><span class='icon-remove-sign'></span></a>
								<br>";
					}
					echo "<br><input type='button' onclick=\" location.href = 'LectureView.php?action=addLecture&id={$row_subjects['id_subject']}'\"  class='button gradient small orange'  value='Добавить лекцию'>
							</td>
							<td>";
						foreach (LecturesModel::getAllLecturesBySubjectId($row_subjects['id_subject']) as $row_lectures) {
							foreach (PracticeModel::getAllPracticeByLectureId($row_lectures['id_lecture']) as $row_practice) {
								echo "<a class='blue' href='TeacherView.php?action=showTest&id_practice={$row_practice['id_practice']}'>".LecturesModel::getLectureNumberById($row_practice['id_lecture']).".&nbsp;".$row_practice['title']."</a>&nbsp;
								<a style='color:orange' href='' title='Изменить'><span class='icon-pencil'></span></a>
								<a style='color:red' href='' title='Удалить'><span class='icon-remove-sign'></span></a>
								<br>";
							}
						}
					echo			"<br><input type='button' onclick=\" location.href = 'TeacherView.php?action=test&id={$row_subjects['id_subject']}'\"  class='button gradient small orange'  value='Добавить тест'>
							</td>
						  </tr>";
					echo "</tbody></table>";
				}
				$i = 0;
				echo "</div></div>";
			}
			echo "</div></div>";
		}
	}
	
	public function getStudentsContent() {
		echo "<h2>Студенты</h2>";
		
		if ($success != "") {
			echo "<div class='alert-msg rnd8 success'>".$success."<a class='close'' href='#'>X</a></div>";
		}
		foreach (SubjectTypesModel::getAllSubjectTypes() as $row_subject_types) {
			echo "
			<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_subject_types['title']."</span></a>
			<div class='toggle-content'>";
			foreach (SubjectsModel::getAllSubjectsCoursesByTeacherIdAndSubjectTypeId($_SESSION['id_user'], $row_subject_types['id_subject_type']) as $row_course) {
				echo "<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_course['course']." курс</span></a>
				<div class='toggle-content'>";
				foreach (ChairsModel::getAllChairs() as $row_chairs) {
			
			echo "
			<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_chairs['title']."</span></a>
			<div class='toggle-content'>";
			foreach (StudentsModel::getAllStudentsByCourseAndChairId($row_course['course'], $row_chairs['id_chair']) as $row_students) {
				if ($row_students['login'] != "admin") {
					$i++;
					echo "<p><img class='boxholder' style='margin-right:20px;float:left;width:150px;height:150px;' src='".$this->STUDENTS_IMAGE_FOLDER.$row_students['photo']."'><br>
					<b>ФИО: <a>".$row_students['fullName']."</a></b><br>
					<b>Логин</b>: ".$row_students['login']."<br>
					<b>Телефон</b>: ".$row_students['telephone']."<br>
					<b>Почта</b>: <a href='mailto:".$row_students['email']."'>".$row_students['email']."</a><br>
					<b>Курс</b>: ".$row_students['course']."<br><br><br><br>
					";
				}
			}
				echo "</p></div></div>";
				}
				echo "</div></div>";
			}
			$i = 0;
			echo "</div></div>";
		}
		echo "</div>";
	}
	public function getScheduleContent() {
		$id_subject_array = $_POST['id_subject'];
		$cabinet_array = $_POST['cabinet'];
		$id_time_array = $_POST['id_time'];
		$week_array = $_POST['id_week'];
		foreach ($id_subject_array as $key => $value) {
			if ($value != "Предмет") {
				ScheduleModel::insertSchedule($id_time_array[$key], $week_array[$key], $_SESSION['id_user'], $value, $cabinet_array[$key]);
			}
		}
		
		echo "<h2>Расписание</h2>";
		if (! ScheduleModel::checkTeacherId($_SESSION['id_user'])) {
			
		foreach (WeeksModel::getAllWeeks() as $row_weeks) {
			echo "<form method='POST' action='TeacherView.php?action=schedule'>";
			echo "<p class='bold orange'>".$row_weeks['title']."</p>";
			echo "<table style='width:80%'>
			<thead>
			<tr>
			<th style='width:50px;'>№ пары</th>
			<th style='width:90px;'>Время</th>
			<th>Предмет</th>
			<th style='width:10px;'>Кабинет</th>
			</tr>
			</thead>
			<tbody>";
			foreach (TimeModel::getAllTime() as $row_time) {
				
				echo "
				
				<tr class='light bold'>
					<td>".$row_time['id_time']." пара</td>
					<td>".$row_time['title']."</td>
					<td><center><select style='width:300px' name='id_subject[]'><option selected>Предмет</option>";
				foreach (SubjectsModel::getAllSubjectsByTeacherId($_SESSION['id_user']) as $row_subjects) {
					echo "<option value='".$row_subjects['id_subject']."'>".$row_subjects['title']." (".$row_subjects['course']." курс ";
					if ($row_subjects['id_subject_type'] == 1) {
						echo FacultiesModel::getFacultyAbbrById($row_subjects['id_faculty']);
					} else {
						echo ChairsModel::getChairAbbrById($row_subjects['id_chair']);
					}
					echo " )</option>";
				}	
				echo "</select>
				<input type='hidden' name='id_time[]' value='".$row_time['id_time']."'>
				<input type='hidden' name='id_week[]' value='".$row_weeks['id_week']."'>
				
				</center></td>
				<td><input  style='width:30px' type='text' name='cabinet[]'></td>
				
				</tr>
				
				";
			}
			echo "</tbody></table>";
		}
		echo "<center><input type='submit' class='button gradient small orange'  value='Добавить'></center></form>";
	
		} else {
			echo "<div class='tab-wrapper rnd10 clear'>
							<ul class='tab-nav clear'>
							<li><a class='blue' href='#tab-1'>Просмотр</a></li>
							<li><a class='blue' href='#tab-2'>Изменение</a></li>
							</ul>
								<div class='tab-container'>
								<div id='tab-1' class='tab-content clear'>";
			foreach (WeeksModel::getAllWeeks() as $row_weeks) {
				if (ScheduleModel::checkWeekId($row_weeks['id_week'], $_SESSION['id_user'])) {
					echo "
								<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_weeks['title']."</span></a>
						<div class='toggle-content'>";
					echo "<table style='width:80%'>
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
					foreach (ScheduleModel::getScheduleByTeacherAndWeekId($_SESSION['id_user'], $row_weeks['id_week']) as $row_schedule) {
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
			
			echo "</div><div id='tab-2' class='tab-content clear'>";
			foreach (WeeksModel::getAllWeeks() as $row_weeks) {
				echo "<form method='POST' action='TeacherView.php?action=schedule'>";
				echo "<p class='bold orange'>".$row_weeks['title']."</p>";
				echo "<table style='width:80%'>
				<thead>
				<tr>
				<th style='width:50px;'>№ пары</th>
				<th style='width:90px;'>Время</th>
				<th>Предмет</th>
				<th style='width:10px;'>Кабинет</th>
				</tr>
				</thead>
				<tbody>";
				foreach (TimeModel::getAllTime() as $row_time) {
			
					echo "
			
					<tr class='light bold'>
					<td>".$row_time['id_time']." пара</td>
					<td>".$row_time['title']."</td>
					<td><center><select style='width:300px' name='id_subject[]'><option selected>Предмет</option>";
					foreach (SubjectsModel::getAllSubjectsByTeacherId($_SESSION['id_user']) as $row_subjects) {
						echo "<option value='".$row_subjects['id_subject']."'>".$row_subjects['title']." (".$row_subjects['course']." курс ";
						if ($row_subjects['id_subject_type'] == 1) {
							echo FacultiesModel::getFacultyAbbrById($row_subjects['id_faculty']);
						} else {
							echo ChairsModel::getChairAbbrById($row_subjects['id_chair']);
						}
						echo " )</option>";
					}
					echo "</select>
					<input type='hidden' name='id_time[]' value='".$row_time['id_time']."'>
					<input type='hidden' name='id_week[]' value='".$row_weeks['id_week']."'>
			
					</center></td>
					<td><input  style='width:30px' type='text' name='cabinet[]'></td>
			
					</tr>
			
					";
				}
				echo "</tbody></table>";
			}
			echo "<center><input type='submit' class='button gradient small orange'  value='Изменить'></center></form></div></div>";
			
		}
		
	}
	public function getAddLectureContent() {
		echo "<center>";
		echo "<form method='POST' enctype='multipart/form-data' class='rnd5' action='TeacherView.php?action=subjects'>
		<br><label for='title'>Название лекции</label><br><br>
		<input type='text' style='width:500px;' name='title'><br>
		<label for='number'>Номер лекции</label><br><br>
		<input type='text' style='width:500px;' name='number'><br>
		<label for='content'>Текст лекции</label><br><br>
		
				<input type='hidden' name='id_subject' value='".$_GET['id']."'>";
		echo "<textarea name='content' id='content' cols='45' rows='500'></textarea>
				<script type='text/javascript'>
					CKEDITOR.replace( 'content', {
						height: '100%',
						width: '100%'
					});
				</script>";
				
		echo "<br><br><input type='submit' class='button gradient small orange'  value='Добавить'></form></center><br>";
	}
	public function getShowLectureContent() {
		$id_lecture = $_GET['id'];
		$content = $_POST['content'];
		$role = $_SESSION['role'];
		$id_user = $_SESSION['id_user'];
		$option = $_GET['option'];
		
		if($option == "export") {
			$this->exportToPDF(LecturesModel::getLectureContentById($id_lecture));
		}
		
		if (isset($content)) {
			CommentsModel::insertComment($content, $id_user, $id_lecture, $role);
		}
		
		
		
		
		echo "<center><h2 class='orange' style='margin-top:10px;'>".LecturesModel::getLectureNumberById($id_lecture).". ".LecturesModel::getLectureTitleById($id_lecture)."</h2></center>
		<span style='margin-left:1200px'><input type='button' onclick=\" location.href = 'LectureView.php?action=showLecture&id={$id_lecture}&option=export'\" class='button gradient small orange'  value='Экспорт в PDF'></span>";
		echo "<div contenteditable='true' class='row3' style='background-color:white;margin:20px;padding:10px;border-width: 1px;
				border-style: solid;'>".LecturesModel::getLectureContentById($id_lecture)."</div>";
		echo "<div id='container'><center><h2 class='orange'>Вопрос - ответ</h2></center>";
		echo "
		<!-- ################################################################################################ -->
		<div class='three_quarter' >
		<div class='push60'>";
		$monthes = array("1"=>"Января",
				"2"=>"Февраль",
				"3"=>"Марта",
				"4"=>"Апреля",
				"5"=>"Мая",
				 "6"=>"Июня",
				 "7"=>"Июля",
				"8"=>"Августа",
				"9"=>"Сентября",
				"10"=>"Октября",
				"11"=>"Ноября",
				"12"=>"Декабря");
		foreach (CommentsModel::getAllCommentsByLectureId($id_lecture) as $row_comments) {
			
			
			if ($row_comments['role'] == "teacher") {
				$day = date('d', strtotime($row_comments['time']));
				$month = date('n',  strtotime($row_comments['time']));
				$year = date('Y', strtotime($row_comments['time']));
				$time = date('H:i', strtotime($row_comments['time']));
				echo "<div class='testimonial push50 clear'>
							<div class='one_quarter first'><center class='blue'>".TeachersModel::getTeacherFullNameById($row_comments['id_user'])."</center><br><img src='".$this->TEACHERS_IMAGE_FOLDER.TeachersModel::getTeacherPhotoById($row_comments['id_user'])."'></div>
							<div class='blue' style='margin-left:290px;'>".$day." ".$monthes[$month]." ".$year." ".$time."</div>
							<div style='margin-top:20px;' class='three_quarter' >
							<blockquote>
							<p>".$row_comments['content']."</p>
							</blockquote>
							
							</div></div><hr>";
			} else {
				$day = date('d', strtotime($row_comments['time']));
				$month = date('n',  strtotime($row_comments['time']));
				$year = date('Y', strtotime($row_comments['time']));
				$time = date('H:i', strtotime($row_comments['time']));
				echo "<div class='testimonial push50 clear'>
				<div class='one_quarter first'><center class='blue'>".StudentsModel::getStudentFullNameById($row_comments['id_user'])."</center><br><img src='".$this->STUDENTS_IMAGE_FOLDER.StudentsModel::getStudentPhotoById($row_comments['id_user'])."'></div>
				<div class='blue' style='margin-left:290px;'>".$day." ".$monthes[$month]." ".$year." ".$time."</div>
				<div style='margin-top:20px;' class='three_quarter' >
				<blockquote>
				<p>".$row_comments['content']."</p>
				</blockquote>
				</div></div><hr>";
			}
		}
		
		echo "</div></div><div class='three_quarter'><center><h2 id='answer' class='orange'>Ответить</h2>
		<form method='POST' class='rnd5' action='LectureView.php?action=showLecture&id=".$id_lecture."#answer'>
				
				<textarea name='content' id='content' cols='5' rows='5'></textarea>
				<script type='text/javascript'>
					CKEDITOR.replace( 'content', {
				toolbar :
		[
		{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
		{ name: 'insert', items : [ 'Image','Flash','Smiley'] }, '/',
		{ name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
		{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'tools', items : [ 'Maximize','-'] }],
						height: '200px',
						width: '100%'
					});
				</script>
				
		<br><br><center><input type='submit' class='button gradient small orange'  value='Ответить'></form></center><br>
				
				</form></div>";
	}
	public function getEditLectureContent() {
		$id_lecture = $_GET['id'];
		echo "<center>";
		echo "<form method='POST' enctype='multipart/form-data' class='rnd5' action='TeacherView.php?action=subjects'>
		<br><label for='title'>Название лекции</label><br><br>
		<input type='text' style='width:500px;' name='title' value='".LecturesModel::getLectureTitleById($id_lecture)."'><br>
		<label for='number'>Номер лекции</label><br><br>
		<input type='text' style='width:500px;' name='number' value='".LecturesModel::getLectureNumberById($id_lecture)."'><br>
		<label for='content'>Текст лекции</label><br><br>
		
				<input type='hidden' name='id_lecture' value='".$_GET['id']."'>";
		echo "<textarea name='content' id='content' cols='45' rows='500'>".LecturesModel::getLectureContentById($id_lecture)."</textarea>
				<script type='text/javascript'>
				
					CKEDITOR.replace( 'content', {
						height: '100%',
						width: '100%'
					});
				</script>";
		echo "<br><br><input type='submit' class='button gradient small orange'  value='Изменить'></form></center><br>";
	}
	
	public static function exportToPDF($content) {
		
		require '../Includes/MPDF56/mpdf.php';
		
		$mpdf = new mPDF('utf-8', 'A4', '8', '', 10, 10, 7, 7, 10, 10); /*задаем формат, отступы и.т.д.*/
		$mpdf->charset_in = 'utf-8'; /*не забываем про русский*/
		
		$stylesheet = file_get_contents('..Includes/Template/layout/styles/main.css'); /*подключаем css*/
		$mpdf->WriteHTML($stylesheet, 1);
		
		$mpdf->list_indent_first_level = 0;
		$mpdf->WriteHTML($content, 2); /*формируем pdf*/
		$mpdf->Output();
	}
}

?>
