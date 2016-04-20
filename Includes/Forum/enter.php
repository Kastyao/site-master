<?php
session_start();
error_reporting(0);
include "config/config.php";
include "header.php";
include "menu.php";
$datetime = date("Y-m-d H:i:s");
if ($_SESSION['enter'] != 1)
 {
$_SESSION['username'] = $_POST['login'];

$login = $_POST['login'];
$password = $_POST['password'];

$c = 0;

$login_check = mysql_query("SELECT * from users where login='$login'");
$login_check_a = mysql_fetch_array($login_check);

$password_check = mysql_query("SELECT * from users where password='$password' and login='$login'");
$password_check_a = mysql_fetch_array($password_check);

       if (isset($login) && $login == "") echo "<p class='error'>Вы не ввели логин!</p>";
  else
if (isset($password) && $password == "") echo "<p class='error'>Вы не ввели пароль!</p>";
 else 
	if (mysql_num_rows($login_check) == 0) echo "<p class='error'>Вы не зарегестрированы!</p>";
 else
	if (isset($password) && mysql_num_rows($password_check) == 0) echo "<p class='error'>Вы ввели не правильный пароль!</p>";
    else if (!isset($login)) $g=1;
    else if ($password_check_a['ban'] == 1) echo "<p class='error'>Вы забанены!</p>";
 	else
      {
    	echo "<script language=JavaScript>window.location='index.php';</script>"; 
 	       $_SESSION['enter'] = 1;
           $_SESSION['id_user'] = $password_check_a['id_user'];
           $put_online = mysql_query("UPDATE users set online=1,last_enter='$datetime' where id_user=".$password_check_a['id_user']."");
           if ($password_check_a['admin'] == 1) $_SESSION['moderator'] = 1;
 	   $c=1;
     }
}
else echo "<script language=JavaScript>window.location.href = 'index.php';</script>";

 if ($c == 0) 
 {
 echo "<center><form method='POST' action='enter.php'>
Ваш логин<br><input type=text name='login'><br>
Ваш пароль<br><input type=password name='password'><br>
<input type='submit' value='Войти'></center>";
}


include "footer.php";
?>