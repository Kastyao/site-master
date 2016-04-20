<?php
error_reporting(0);
include "config/config.php";
include "header.php";
include "menu.php";
if ($_SESSION['username'] == "admin")
{
$c = 0;
$name = $_POST['name'];
$hidden_theme = $_POST['hidden'];
if ($hidden_theme == "on") $hidden = 1;
else $hidden = 0;
if (isset($name) && $name != "")
{
    $add = mysql_query("INSERT into global_theme(name,hidden) values('$name','$hidden')");
    $c = 1;
    $name = "";
}
if ($c == 0)
{
echo "<center><form action='add_global_theme.php' method='POST'>
Введите название глобальной темы  <br><br><input type='text' name='name'><br><br>
<input type=checkbox name='hidden'>  Видна только модераторам<br> 
<input type='submit' value='Создать'>
</form></center>";
}
if ($c == 1)
{
    echo "<p class=create>Глобальная тема успешно создана</p>";
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"index.php\"",1000);</script>'; 
}
}
else echo "<script language=JavaScript>window.location = 'index.php?';</script>";
include "footer.php";
?>