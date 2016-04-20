<?php
require_once '../Includes/Scripts/autoload.php';

class AdminController {
	private $IMAGE_FOLDER = '../Includes/Images/';
	private $TEACHERS_IMAGE_FOLDER = '../Includes/Images/Teachers/';
	private $STUDENTS_IMAGE_FOLDER = '../Includes/Images/Students/';
	
	public function checkContent() {
		$action = $_GET['action'];
		switch ($action) {
			case "institutes": $this->getInstitutesContent();
								break;
			case "faculties":  $this->getFacultiesContent();
								break;
			case "chairs":  $this->getChairsContent();
								break;
			case "teachers":  $this->getTeachersContent();
								break;
			case "students":  $this->getStudentsContent();
								break;
			case "subjects":  $this->getSubjectsContent();
								break;
			case "": $this->getIndexContent();
								break;
		}
	}
	
	private function getIndexContent() {
		echo "<h2>Статистика системы</h2>";
		echo "<p>Всего в системе :</p>";
		echo "<div class='skillset push30'>
          <ul class='nospace bold orange clear'>
				<li class='size-".(InstitutesModel::getInstitutesCount() * 10)."'>Институтов:
              		<div class='rnd5'><strong class='rnd5  orange'>".InstitutesModel::getInstitutesCount()."</strong></div>
            	</li>
              	<li class='size-".(FacultiesModel::getFacultiesCount() * 10)."'>Факультетов:
              		<div class='rnd5'><strong class='rnd5'>".FacultiesModel::getFacultiesCount()."</strong></div>
            	</li>
              	<li class='size-".(ChairsModel::getChairsCount() * 10)."'>Кафедр:
              		<div class='rnd5'><strong class='rnd5'>".ChairsModel::getChairsCount()."</strong></div>
            	</li>
              	<li class='size-".(TeachersModel::getTeachersCount() * 10)."'>Преподавателей:
              		<div class='rnd5'><strong class='rnd5'>".TeachersModel::getTeachersCount()."</strong></div>
            	</li>
              	<li class='size-".(StudentsModel::getStudentsCount() * 10)."'>Студентов:
              		<div class='rnd5'><strong class='rnd5'>".StudentsModel::getStudentsCount()."</strong></div>
            	</li>
              	<li class='size-".(SubjectsModel::getSubjectsCount() * 10)."'>Предметов:
              		<div class='rnd5'><strong class='rnd5'>".SubjectsModel::getSubjectsCount()."</strong></div>
            	</li>	
			</ul>
            </div>";
	}
	
	private function getInstitutesContent() {

		$abbr = $_POST['abbr'];
		$title = $_POST['title'];
		$id_institute = $_GET['id'];
		$option = $_GET['option'];
		
		if (isset($abbr) && isset($title)) {
			InstitutesModel::insertIntoInstitutes($abbr, $title);
			$success = "Институт успешно добавлен !";
		}
		if ($option == "delete") {
			InstitutesModel::deleteInstituteById($id_institute);
			$success = "Институт успешно удалён !";
		}
		
		echo "<h2>Институты</h2>";
		if ($success != "") {
			echo "<div class='alert-msg rnd8 success'>".$success."<a class='close'' href='#'>X</a></div>";
		}
		echo "<table>";
		echo "<thead><tr><th width='5px;'>№</th><th>Сокращение</th><th>Название</th></tr></thead>
				<tbody>";
		$i = 0;
		foreach (InstitutesModel::getAllInstitutes() as $row) {
			$i++;
			echo "<tr class='light bold'><td>{$i}</td><td>".$row['abbr']."</td><td>".$row['title']."&nbsp;&nbsp;&nbsp;&nbsp;
					<a id='change_institute' title='Изменить'><span class='icon-pencil'></span></a>&nbsp;&nbsp;<a style='color:red' href='AdminView.php?action=institutes&option=delete&id=".$row['id_institute']."' title='Удалить'><span class='icon-remove-sign'></span></a></td>";
		}
		
		echo "<tr class='dark bold'><td>".($i+1)."</td>
				<form class='rnd5' action='AdminView.php?action=institutes' method='post'>
					            <td><input type='text' name='abbr' id='abbr' value='' size='22' style='width:40%'></td>
					            <td><input  type='text' name='title' id='title' value='' size='22' style='width:70%'>
					    		<input type='submit' value='Добавить' class='button gradient small orange'></td>
				</form>
			</tr>";
		echo "</tbody></table>";
	}
	
	private function getFacultiesContent() {
	
		$abbr = $_POST['abbr'];
		$title = $_POST['title'];
		$id_faculty = $_GET['id'];
		$option = $_GET['option'];
		$id_institute = $_POST['id_institute'];
		
		if (isset($abbr) && isset($title)) {
			FacultiesModel::insertFaculty($id_institute, $abbr, $title);
			$success = "Факультет успешно добавлен !";
		}
		if ($option == "delete") {
			FacultiesModel::deleteFacultyById($id_faculty);
			$success = "Факультет успешно удалён !";
		}
	
		echo "<h2>Факультеты</h2>";
		
		
		if ($success != "") {
			echo "<div class='alert-msg rnd8 success'>".$success."<a class='close'' href='#'>X</a></div>";
		}
		
		$i = 0;
		foreach (InstitutesModel::getAllInstitutes() as $row) {
			echo "<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row['title']."</span></a>
          <div class='toggle-content'>";
			echo "<table>";
			echo "<thead><tr><th width='5px;'>№</th><th>Сокращение</th><th>Название</th></tr></thead>
				<tbody>";
			foreach (FacultiesModel::getAllFacultiesByInstituteId($row['id_institute']) as $row_faculty) {
				$i++;
				
				echo "<tr class='light bold'><td>{$i}</td><td>".$row_faculty['abbr']."</td><td>".$row_faculty['title']."&nbsp;&nbsp;&nbsp;&nbsp;
					<a id='change_institute' title='Изменить'><span class='icon-pencil'></span></a>&nbsp;&nbsp;<a style='color:red' href='AdminView.php?action=faculties&option=delete&id=".$row_faculty['id_faculty']."' title='Удалить'><span class='icon-remove-sign'></span></a></td>";
			}
			echo "<tr class='dark bold'><td>".($i+1)."</td>
				<form class='rnd5' action='AdminView.php?action=faculties' method='post'>
					            <td><input type='text' name='abbr' id='abbr' value='' size='22' style='width:40%'></td>
					            <td><input  type='text' name='title' id='title' value='' size='22' style='width:70%'>
									<input type='hidden' name='id_institute' value='".$row['id_institute']."'>
					    		<input type='submit' value='Добавить' class='button gradient small orange'></td>
				</form>
			</tr>";
			$i = 0;
			echo "</tbody></table>";
			echo "</div></div>";
		}
	}
	
	private function getChairsContent() {
		
		$abbr = $_POST['abbr'];
		$title = $_POST['title'];
		$id_faculty = $_POST['id_faculty'];
		$address = $_POST['address'];
		$telephone = $_POST['telephone'];
		$id_teacher_head = $_POST['id_teacher_head'];
		$option = $_GET['option'];
		$id_chair = $_GET['id'];
		if (isset($abbr) && isset($title)) {
			ChairsModel::insertChair($abbr, $title, $id_faculty,
									 $address, $telephone, $id_teacher_head);
			$success = "Кафедра успешно добавлена !";
		}
		if ($option == "delete") {
			ChairsModel::deleteChairById($id_chair);
			$success = "Кафедра успешно удалена !";
		}
		
		echo "<h2>Кафедры</h2>";
		
		
		if ($success != "") {
			echo "<div class='alert-msg rnd8 success'>".$success."<a class='close'' href='#'>X</a></div>";
		}
		
		$i = 0;
		foreach (InstitutesModel::getAllInstitutes() as $row) {
			echo "<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row['title']."</span></a>
			<div class='toggle-content'>";
			foreach (FacultiesModel::getAllFacultiesByInstituteId($row['id_institute']) as $row_faculty) {
		
				echo "<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_faculty['title']."</span></a>";
				
				echo "<div class='toggle-content'>";
				echo "<table>";
				echo "<thead><tr><th width='5px;'>№</th><th>Сокращение</th><th>Название</th><th>Адрес</th><th>Телефон</th><th>Заведующий</th></tr></thead>
				<tbody>";
				foreach (ChairsModel::getAllChairsByFacultyId($row_faculty['id_faculty']) as $row_chairs) {
					$i++;
					$id_chairs_array[] = array($row_chairs['id_chair']);
					echo "<tr class='light bold'><td>{$i}</td><td>".$row_chairs['abbr']."</td><td>".$row_chairs['title']."</td>
							<td>".$row_chairs['address']."</td><td>".$row_chairs['telephone']."</td>
							<td>".TeachersModel::getTeacherFullNameById($row_chairs['id_teacher_head'])."&nbsp;&nbsp;<a style='color:red' href='AdminView.php?action=chairs&option=delete&id=".$row_chairs['id_chair']."' title='Удалить'><span class='icon-remove-sign'></span></a></td></tr>";
				}
				
				
				echo "<tr class='dark bold'><td>".($i+1)."</td>
				<form class='rnd5' action='AdminView.php?action=chairs' method='post'>
				<td><input type='text' name='abbr' value='' size='22' style='width:40%'></td>
				<td><input  type='text' name='title' value='' size='22' style='width:70%'>
				<input type='hidden' name='id_faculty' value='".$row_faculty['id_faculty']."'></td>
				<td><input  type='text' name='address'  value='' size='22' style='width:70%'></td>
				<td><input  type='text' name='telephone' value='' size='22' style='width:70%'></td>
				<td>
				<select name='id_teacher_head'>
				";
					foreach (ChairsModel::getAllChairsIdByFacultyId($row_faculty['id_faculty']) as $row_chairs_id) {
						foreach (TeachersModel::getTeachersFullNameByChairId($row_chairs_id['id_chair'])
									 as $row_teachers) {
							echo "<option value='".$row_teachers['id_teacher']."'>".$row_teachers['fullName']."</option>";
						}
					}
				echo "</select>
				<input type='submit' value='Добавить' class='button gradient small orange'></td>
				</form>
				</tr>";
				$i = 0;
				echo "</tbody></table>";
				echo "</div>";
				
				echo "</div>";
			}
				
				echo "</div>";
		}
	}
	
	private function getTeachersContent() {
		$lastName = $_POST['lastName'];
		$firstName = $_POST['firstName'];
		$middleName = $_POST['middleName'];
		$login = $_POST['login'];
		$password = $_POST['password'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		$birthday = $_POST['birthday'];
		$id_teaching_position = $_POST['id_teaching_position'];
		$id_degree = $_POST['id_degree'];
		$id_chair = $_POST['id_chair'];
		
		$photo = basename($_FILES['photo']['name']);
		$uploadfile = $this->TEACHERS_IMAGE_FOLDER . basename($_FILES['photo']['name']);
		move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
		
		echo $photo;
		
		/*if (isset($lastName) && isset($firstName)) {
			TeachersModel::insertTeacher($login, $password, $firstName,
											 $lastName, $middleName, $telephone,
											  $email, $id_chair, $id_teaching_position,
											   $id_degree, $birthday, $photo);
			$success = "Преподаватель успешно добавлен !";
		}*/
		/*if ($option == "delete") {
			InstitutesModel::deleteInstituteById($id_institute);
			$success = "Преподаватель успешно удалён !";
		}*/
		
		echo "<h2>Преподаватели</h2>";
		
		if ($success != "") {
			echo "<div class='alert-msg rnd8 success'>".$success."<a class='close'' href='#'>X</a></div>";
		}
		
		echo "
		<div class='tab-wrapper rnd10 clear'>
					<ul class='tab-nav clear'>
						<li><a class='blue' href='#tab-1'>Просмотр</a></li>
						<li><a class='blue' href='#tab-2'>Добавление</a></li>
					</ul>
					<div class='tab-container'>
					<div id='tab-1' class='tab-content clear'>";
		foreach (ChairsModel::getAllChairs() as $row_chairs) {
			
		echo "			
					<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_chairs['title']."</span></a>
						<div class='toggle-content'>";
			foreach (TeachersModel::getAllTeachersByChairId($row_chairs['id_chair']) as $row_teachers) {
				$i++;
							echo "<p><img class='boxholder' style='margin-right:20px;float:left;width:150px;height:150px;' src='".$this->TEACHERS_IMAGE_FOLDER.$row_teachers['photo']."'><br>
							<b>ФИО: <a>".$row_teachers['fullName']."</a></b><br>
							<b>Логин</b>: ".$row_teachers['login']."<br>
							<b>Телефон</b>: ".$row_teachers['telephone']."<br>
							<b>Почта</b>: <a href='".$row_teachers['email']."'>".$row_teachers['email']."</a><br>
							<b>Преподовательская должность</b>: ".TeachingPositionsModel::getTeachingPositionTitleById($row_teachers['id_teaching_position'])."<br>
							<b>Учёная степень</b>: ".DegreesModel::getDegreeTitleById($row_teachers['id_degree'])."<br>
							<b>Дата рождения</b>:".$row_teachers['birthday']."<br><br><br>
							";
			}
			$i = 0;
			echo "</p></div></div>";
			
		}
		echo "</div>
			<div id='tab-2' class='tab-content clear'>";
		echo "<div class='one_third'>
				<form method='POST' enctype='multipart/form-data' class='rnd5' action='AdminView.php?action=teachers'>
				<label for='lastName'>Фамилия</label>
				<input type='text' style='width:200px;' name='lastName'>
				<label for='firstName' style='width:200px;'>Имя</label>
				<input type='text' style='width:200px;' name='firstName'>
				<label for='middleName'>Отчество</label>
				<input type='text' style='width:200px;' name='middleName'>
				<label for='login'>Логин</label>
				<input type='text' style='width:200px;' name='login'>
				<label for='password'>Пароль</label>
				<input type='password' style='width:200px;' name='password'>
				<label for='telephone'>Телефон</label>
				<input type='text' style='width:200px;' name='telephone'>
				<label for='email'>Почта</label>
				<input type='text' style='width:200px;' name='email'>
				<label for='birthday'>Дата рождения</label><br>
				<input type='text' id='datepicker' style='width:200px;' name='birthday'></div><div class='one_third'>
				<label for='id_chair'>Кафедра</label><br>
				<select name='id_chair' style='height:25px;'>";
			foreach (ChairsModel::getAllChairs() as $row_chairs) {
				echo "<option value='".$row_chairs['id_chair']."'>".$row_chairs['title']."</option>";
			}
		echo "</select><br><br>
				<label for='id_chair'>Преподавательская должность</label><br>
				<select name='id_teaching_position' style='height:25px;'>";
			foreach (TeachingPositionsModel::getAllTeachingPositions() as $row_teaching_position) {
				echo "<option value='".$row_teaching_position['id_teaching_position']."'>".$row_teaching_position['title']."</option>";
			}
		echo "</select><br><br>
				<label for='id_degree'>Учёная степень</label><br>
				<select name='id_degree' style='height:25px;'>";
			foreach (DegreesModel::getAllDegrees() as $row_degrees) {
				echo "<option value='".$row_degrees['id_degree']."'>".$row_degrees['title']."</option>";
			}
		echo "</select><br><br>
				<label for='photo'>Фотография</label>
				<input type='file' name='photo'><br><br>
				<input type='submit' class='button gradient small orange' value='Добавить'></form>
				</div>";
		echo "</div></div></div></div>";
	}

	private function getStudentsContent() {
		$lastName = $_POST['lastName'];
		$firstName = $_POST['firstName'];
		$middleName = $_POST['middleName'];
		$login = $_POST['login'];
		$password = $_POST['password'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		$id_chair = $_POST['id_chair'];
		$course = $_POST['course'];
	
		$photo = basename($_FILES['photo']['name']);
		$uploadfile = $this->STUDENTS_IMAGE_FOLDER . basename($_FILES['photo']['name']);
		move_uploaded_file($_FILES['photo']['tmp_name'], $uploadfile);
	
		if (isset($lastName) && isset($firstName)) {
			StudentsModel::insertStudent($login, $password,
					 $firstName, $lastName, $middleName,
					 $telephone, $email, $id_chair, $course, $photo);
			$success = "Студент успешно добавлен !";
		}
		/*if ($option == "delete") {
			InstitutesModel::deleteInstituteById($id_institute);
			$success = "Студент успешно удалён !";
		}*/
	
		echo "<h2>Студенты</h2>";
	
		if ($success != "") {
			echo "<div class='alert-msg rnd8 success'>".$success."<a class='close'' href='#'>X</a></div>";
		}
	
		echo "
		<div class='tab-wrapper rnd10 clear'>
		<ul class='tab-nav clear'>
		<li><a class='blue' href='#tab-1'>Просмотр</a></li>
		<li><a class='blue' href='#tab-2'>Добавление</a></li>
		</ul>
		<div class='tab-container'>
		<div id='tab-1' class='tab-content clear'>";
		foreach (ChairsModel::getAllChairs() as $row_chairs) {
				
			echo "
			<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_chairs['title']."</span></a>
			<div class='toggle-content'>";
			foreach (StudentsModel::getAllStudentsByChairId($row_chairs['id_chair']) as $row_students) {
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
			$i = 0;
			echo "</p></div></div>";
		}
		echo "</div>
		<div id='tab-2' class='tab-content clear'>";
		echo "<div class='one_third'>
		<form method='POST' enctype='multipart/form-data' class='rnd5' action='AdminView.php?action=students'>
		<label for='lastName'>Фамилия</label>
		<input type='text' style='width:200px;' name='lastName'>
		<label for='firstName' style='width:200px;'>Имя</label>
		<input type='text' style='width:200px;' name='firstName'>
		<label for='middleName'>Отчество</label>
		<input type='text' style='width:200px;' name='middleName'>
		<label for='login'>Логин</label>
		<input type='text' style='width:200px;' name='login'>
		<label for='password'>Пароль</label>
		<input type='password' style='width:200px;' name='password'>
		<label for='telephone'>Телефон</label>
		<input type='text' style='width:200px;' name='telephone'>
		<label for='email'>Почта</label>
		<input type='text' style='width:200px;' name='email'></div><div class='one_third'>
		<label for='id_chair'>Кафедра</label><br>
		<select name='id_chair' style='height:25px;'>";
		foreach (ChairsModel::getAllChairs() as $row_chairs) {
			echo "<option value='".$row_chairs['id_chair']."'>".$row_chairs['title']."</option>";
		}
		echo "</select><br><br>";
		
		echo "<label for='course'>Курс</label><br>
			<select name='course' style='height:25px;'>";
		
		for ($i = 1; $i < 6; $i++) {
			echo "<option value='{$i}'>{$i}</option>";
		}
		
		echo "</select><br><br>
		<label for='photo'>Фотография</label>
		<input type='file' name='photo'><br><br>
		<input type='submit' class='button gradient small orange' value='Добавить'></form>
		</div>";
		echo "</div></div></div></div>";
	}

	private function getSubjectsContent() {
		
		$title = $_POST['title'];
		$id_teacher = $_POST['id_teacher'];
		$id_subject_type = $_POST['id_subject_type'];
		$course = $_POST['course'];
		$id_chair = $_POST['id_chair'];
		$id_subject = $_GET['id'];
		$option = $_GET['option'];
		if (isset($title) && isset($id_teacher)) {
			$id_faculty = ChairsModel::getFacultyIdByChairId($id_chair);
			// Если выбран основной курс
			if ($id_subject_type == 1) {
					SubjectsModel::insertSubject($title, $id_teacher,
							 $id_faculty, NULL,
							 $id_subject_type, $course);
			} else {
				SubjectsModel::insertSubject($title, $id_teacher,
						$id_faculty, $id_chair,
						$id_subject_type, $course);
			}
			$success = "Предмет успешно добавлен !";
		}
		if ($option == "delete") {
				SubjectsModel::deleteSubject($id_subject);
				$success = "Предмет успешно удалён !";
		}
	
		echo "<h2>Предметы</h2>";
	
		if ($success != "") {
			echo "<div class='alert-msg rnd8 success'>".$success."<a class='close'' href='#'>X</a></div>";
		}
	
		echo "
		<div class='tab-container'>
		<div id='tab-1' class='tab-content clear'>";
		foreach (ChairsModel::getAllChairs() as $row_chairs) {
	
			echo "
			<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>".$row_chairs['title']."</span></a>
			<div class='toggle-content'>";
			for ($course = 1; $course < 6; $course ++) {
				echo "<div class='toggle-wrapper'><a href='javascript:void(0)' class='toggle-title orange'><span>{$course} Курс</span></a>
				<div class='toggle-content'>";
				echo "<table>";
				echo "<thead><tr><th width='5px;'>№</th><th>Название</th><th width='40%'>Преподаватель</th><th>Тип</th></tr></thead>
				<tbody>";
				foreach (SubjectsModel::getAllSubjectsByFacultyOrChairId($row_chairs['id_faculty'], $row_chairs['id_chair'], $course) as $row_subjects) {
					if ($row_subjects['id_chair'] == NULL) {
						if (ChairsModel::checkFacultyContainsChair($row_subjects['id_faculty'], $row_chairs['id_chair'])) {
							$i++;
							echo "<tr class='light bold'><td>{$i}</td>
										<td>".$row_subjects['title']."</td><td>".TeachersModel::getTeacherFullNameById($row_subjects['id_teacher'])."</td>
										<td>".SubjectTypesModel::getSubjectTypeTitleById($row_subjects['id_subject_type'])."
										&nbsp;&nbsp;<a style='color:red' href='AdminView.php?action=subjects&option=delete&id=".$row_subjects['id_subject']."' title='Удалить'><span class='icon-remove-sign'></span></a></td></tr>";
						}
					}	else {
						$i++;
						echo "<tr class='light bold'><td>{$i}</td>
						<td>".$row_subjects['title']."</td><td>".TeachersModel::getTeacherFullNameById($row_subjects['id_teacher'])."</td>
								<td>".SubjectTypesModel::getSubjectTypeTitleById($row_subjects['id_subject_type'])."
								&nbsp;&nbsp;<a style='color:red' href='AdminView.php?action=subjects&option=delete&id=".$row_subjects['id_subject']."' title='Удалить'><span class='icon-remove-sign'></span></a></td></tr>";
					}
				}
				echo "<tr class='dark bold'><td>".($i+1)."</td>
				<form class='rnd5' action='AdminView.php?action=subjects' method='post'>
				<td><input type='text' name='title' id='abbr' value='' size='22' style='width:70%'></td>
				<td><select name='id_teacher'>";
				foreach (TeachersModel::getTeachersFullNameByChairId($row_chairs['id_chair'])
						as $row_teachers) {
					echo "<option value='".$row_teachers['id_teacher']."'>".$row_teachers['fullName']."</option>";
				}
				echo "</select></td>
				<td><select name='id_subject_type'>";
				
				foreach (SubjectTypesModel::getAllSubjectTypes() as $row_subject_types) {
					echo "<option value='".$row_subject_types['id_subject_type']."'>".$row_subject_types['title']."</option>";
				}
				
				echo "</select><br>
				<input type='hidden' name='id_chair' value='".$row_chairs['id_chair']."'>
				<input type='hidden' name='course' value='{$course}'>
				<input type='submit' value='Добавить' class='button gradient small orange'></td>
				</form>
				</tr>";
				$i = 0;
				echo "</tbody></table></div></div>";
			} 
			
			echo "</div></div>";
		}
		echo "</div>";
	}
}
?>
