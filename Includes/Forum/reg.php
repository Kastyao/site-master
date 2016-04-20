<head>
<script language="javascript" src="jquery-latest.js"></script>
<script language="javascript" src="java.js"></script>

</head>	
<?php
session_start();
error_reporting(0);
mysql_error(0);
$avatar = $HTTP_POST_VARS['avatar'];
$file_name = $_FILES['avatar']['name'];
$file_size = $_FILES['avatar']['size'];
$file_type = $_FILES['avatar']['type'];
$file_tmp = $_FILES['avatar']['tmp_name'];

include "config/config.php";
include "header.php";
include "menu.php";
 if ($_SESSION['enter'] != 1 )
{
$login = $_POST['login'];
$password = $_POST['password'];
$password_check = $_POST['password_check'];
$email = $_POST['email'];
$icq = $_POST['icq'];
$podpis = $_POST['podpis'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$datetime = date("Y-m-d H:i:s");
//Проверка мыла
$str=$_POST['email'];
$digit="(^[[:digit:]])";
$pod="_";
$sobaka="@?";
$simb="[#$%^&*()_=+~*/]";
$prov="([[:alnum:]]+@)";
$sob="(@+[[:alpha:]])";
$ru="ru$";
$com="com$";
$ua="ua$";
$prob="([[:space:]])";

if ($file_name == "") $file_name = "default.jpg";
if (!isset($icq)) $icq = "";
 
$check_login = mysql_query("SELECT login from users where login like '$login'");

if (isset($login) && $login == "") echo "<p class='error'>Вы не ввели логин!</p>";
else if (mysql_num_rows($check_login) != 0) echo "<p class='error'>Пользователь с таким логином уже существует</p>";
 else if (isset($password) && $password == "") echo "<p class='error'>Вы не ввели пароль</p>";

   else if (isset ($email) && ereg($digit,$str))	echo "<p class='error'>Первый символ должен быть буквой</p>";
	else if (isset ($email) && ereg($simb,$str)) echo "<p class='error'>Нельзя вводить постороние символы</p>";
	  else if (isset ($email) && ereg($prov,$str)!=true) echo "<p class='error'>Вы не ввели @ или поставили @ на неправильное место</p>";
		   else if (isset ($email) && ereg($sob,$str)!=true) echo "<p class='error'>Имя домена должно начинатся с буквы</p>";
			else if (isset ($email) && ereg($ru,$str) == false && ereg($com,$str) == false && ereg($ua,$str)==false)echo "<p class='error'>Введён неправильный адресс</p>";
			   else if (isset ($email) && ereg($prob,$str)) echo "<p class='error'>Нельзя вводить пробелы</p>";
			    else if (isset ($email) && isset($password) && isset($login) && $login != "" && $password != "")
                    {
                        $c = 1;
                        $result = mysql_query("INSERT into users (login,password,admin,sex,age,avatar,email,icq,themes,texts,status,podpis,date,last_enter,ban,online,reputation) 
                        VALUES ('$login','$password','0','$sex','$age','$file_name','$email','$icq','0','0','Новичок','$podpis','$datetime','$datetime','0','0','0')");
                        move_uploaded_file($file_tmp, 'images/'.$file_name);
                             echo "<p class=create>Вы успешно зарегестрировались</p>";
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"index.php\"",1000);</script>';
                    }         
if ($c != 1)
{
echo "<html>
<body><p class='error' align=right>Поля отмеченные * обязательны для заполнения</p>
<form enctype='multipart/form-data' action='reg.php' method='POST'>
<table width=100%>

<tr><td class='noborder'>Введите логин * <br><input type=text name='login' onChange='check_login(login.value);'><span id='log_'></span></td></td></tr>
<tr><td class='noborder'>Введите пароль * <br><input type=password name='password' ></td></tr>
<tr><td class='noborder'>Повторите пароль * <br><input type=password name='password_check' onChange='check_pass(password.value,password_check.value);'><span  id='check'></span></td></tr>
<tr><td class='noborder'>Введите свой email * <br><input type=text name='email'></td></tr>
<tr><td class='noborder'>Введите своё icq  <br><input type=text name='icq'></td></tr>
<tr><td class='noborder'>Введите подпись  <br><input type=text name='podpis'></td></tr>
<tr><td class='noborder'>Ваш пол * <br><select name='sex'><option>Мужской</option><option>Женский</option></select></td></tr>
<tr><td class='noborder'>Ваш возраст *<br><select name='age'>";
for ($i=12;$i<100;$i++) echo '<option>'.$i.'</option>';
echo "</select>";
echo "
<tr><td class='noborder' >Выберите аватар - <br><input type='file' name='avatar' size=65></td></tr>
</table>
<center><br><br><input type='submit' value='Зарегестрироваться' ></center>
</form>
</body>
</html>";
}
}
 else
  echo "<script language=JavaScript>window.location = 'index.php';</script>";
             
include "footer.php";
?>
