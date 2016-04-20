<?php
require_once '../Includes/Scripts/autoload.php';

class MainController {

	public static function getLoginForm() {
		if ($_GET['action'] == "logout") {
			session_destroy();
			header('Location:IndexView.php');
		}
		if (! isset($_SESSION['id_user'])) {
			
				if (isset($_POST['login']) && isset($_POST['password'])) {
					$login = $_POST['login'];
					$password = $_POST['password'];
					if (StudentsModel::checkPassword($login, $password)) {
						if ($login == "admin") {
							session_start();
							$_SESSION['id_user'] = StudentsModel::getStudentIdByLogin($login);
							$_SESSION['role'] = "admin";
							header('Location:IndexView.php');
						} else {
							session_start();
							$_SESSION['id_user'] = StudentsModel::getStudentIdByLogin($login);
							$_SESSION['role'] = "student";
							header('Location:IndexView.php');
						}
					} else {
						if (TeachersModel::checkPassword($login, $password)) {
							session_start();
							$_SESSION['id_user'] = TeachersModel::getTeacherIdByLogin($login);
							$_SESSION['role'] = "teacher";
							header('Location:IndexView.php');
							
						} else if (isset($login) && isset($password)) {
							$error = "<div class='alert-msg rnd8 error bold' style='color: black;'>Логин или пароль введён не правильно !</div>";
						}
					}
				}
				echo $error;
				echo "<form class='rnd5'' action='IndexView.php' method='post'>
					        <div class='form-input clear'>
					          <label class='one_half' for='login'>Логин <span class='required'>*</span>
					            <input type='text'' name='login' id='login' value='' size='22' style='width:150px'>
					          </label>
					          <label class='one_half' for='password'>Пароль <span class='required'>*</span><br>
					            <input  type='password' name='password' id='password' value='' size='22'' style='width:150px'>
					          </label>
					    		<input type='submit'' style='height: 0px; width: 0px; border: none; padding: 0px;'/>
					    	</div>
					      </form>";
					
		}	else { 
			switch ($_SESSION['role']) {
				case "admin" : echo "<br>Добро пожаловать, <b>".StudentsModel::getStudentFirstNameById($_SESSION['id_user'])." ".StudentsModel::getStudentMiddleNameById($_SESSION['id_user'])."</b><br><a href='IndexView.php?action=logout'>Выйти из профиля</a>";
								break;
				case "student" : if (StudentsModel::getStudentPasswordById($_SESSION['id_user']) == md5("qwerty")) {
										echo "<div class='alert-msg rnd8 error bold' style='color: black;'><u><a style='color: black;' href='StudentView.php?action=profile'>Вам необходимо сменить пароль !</a></u></div>";
								 }	
									echo "<br>Добро пожаловать, <b>
									".StudentsModel::getStudentFirstNameById($_SESSION['id_user'])." 
									".StudentsModel::getStudentMiddleNameById($_SESSION['id_user'])."
									</b><br><a href='IndexView.php?action=logout'>Выйти из профиля</a>";
								 break;
				case "teacher" : if (TeachersModel::getTeacherPasswordById($_SESSION['id_user']) == md5("qwerty")) {
										echo "<div class='alert-msg rnd8 error bold' style='color: black;'><u><a style='color: black;' href='TeacherView.php?action=profile'>Вам необходимо сменить пароль !</a></u></div>";
								 }	
									echo "<br>Добро пожаловать, <b>
									".TeachersModel::getTeacherFirstNameById($_SESSION['id_user'])." 
									".TeachersModel::getTeacherMiddleNameById($_SESSION['id_user'])."
									</b><br><a href='IndexView.php?action=logout'>Выйти из профиля</a>";
								 break;
			}
		}
	}
	
	public static function getExtraMenu() {
		switch ($_SESSION['role']) {
			case "admin" : echo "<li><a class='drop' href='AdminView.php' title='Администрирование'>Администрирование</a>
									<ul>
										<li><a href='AdminView.php?action=institutes' title='Институты'>Институты</a></li>
										<li><a href='AdminView.php?action=faculties' title='Факультеты'>Факультеты</a></li>
										<li><a href='AdminView.php?action=chairs' title='Кафедры'>Кафедры</a></li>
										<li><a href='AdminView.php?action=teachers' title='Преподаватели'>Преподаватели</a></li>
										<li><a href='AdminView.php?action=students' title='Студенты'>Студенты</a></li>
										<li><a href='AdminView.php?action=subjects' title='Предметы'>Предметы</a></li>
									</ul>
								<li>";
							break;
			case "teacher" : echo "<li><a class='drop' href='TeacherView.php?action=subjects' title='Раздел преподавателя'>Раздел преподавателя</a>
									<ul>
										<li><a href='TeacherView.php?action=subjects' title='Предметы'>Предметы</a></li>
										<li><a href='TeacherView.php?action=students' title='Студенты'>Студенты</a></li>
										<li><a href='TeacherView.php?action=schedule' title='Расписание'>Расписание</a></li>
										<li><a href='TeacherView.php?action=profile' title='Мой профиль'>Мой профиль</a></li>
									</ul>
								<li>";
							break;
			case "student" : echo "<li><a class='drop' href='StudentView.php?action=subjects' title='Раздел студента'>Раздел студента</a>
							<ul>
								<li><a href='StudentView.php?action=subjects' title='Предметы'>Предметы</a></li>
								<li><a href='StudentView.php?action=teachers' title='Преподаватели'>Преподаватели</a></li>
								<li><a href='StudentView.php?action=profile' title='Мой профиль'>Мой профиль</a></li>
								
							</ul>
							<li>";
							break;
		}
		
	}
	
}

?>