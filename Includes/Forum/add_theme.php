<?php
error_reporting(0);
session_start();
include "config/config.php";
include "header.php";
include "menu.php";
if ($_SESSION['moderator'] == 1)
{

$global_theme_id = $_GET['t'];
$c = 0;
$name = $_POST['name'];
$find_theme = mysql_query("SELECT * from theme where name like '%".strtoupper($name)."%'");
if (isset($name) && $name != "" && mysql_num_rows($find_theme) == 0)
{
    $add = mysql_query("INSERT into theme(id_global_theme,name) values('$global_theme_id','$name')");
    $c = 1;
    $name = "";
}
else if (isset($name) && $name == "")  echo "<p class='error'>Введите название темы</p>";
if (isset($name) && mysql_num_rows($find_theme) !=0 ) echo "<p class='error'>Такая подтема уже существует!</p>";
if ($c == 0)
{
echo "<center><form action='add_theme.php?t=".$global_theme_id."' method='POST'>
Введите название темы  <br><br><input type='text' name='name'><br><br>
<input type='submit' value='Создать'>
</form></center>";
}
if ($c == 1)
{
    echo "<p class=create>Тема успешно создана</p>";
     echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewforum.php?t='.$global_theme_id.'\"",1000);</script>';
   
    
}
}
else echo "<script language=JavaScript>window.location = 'index.php?';</script>"; 
include "footer.php";
?>