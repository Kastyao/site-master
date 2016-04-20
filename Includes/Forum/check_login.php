<script>alert("asd");</script>
<?php
	include "config/config.php";
    echo "asdasdasda";
	$check_login = mysql_query("SELECT * FROM users WHERE login like '".$_POST['log']."'");
	
	if(mysql_num_rows($check_login) == 0)
		echo "document.getElementById('log_').innerHTML = '&nbsp;&nbsp;<font color=red>Логин свободен</font>'";
	if(mysql_num_rows($check_login) >= 1)
		echo "document.getElementById('log_').innerHTML = '&nbsp;&nbsp;<font color=green>Пользователь с таким логином уже существует</font>'";

?>