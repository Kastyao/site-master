<?php
include "config/config.php";
include "header.php";
include "menu.php";
$theme = $_GET['s'];
$t = $_GET['t'];
$selected_theme = mysql_query("SELECT * from theme where id_theme='$theme'");
$selected_theme_a = mysql_fetch_array($selected_theme);
$name = $_POST['name'];
if (isset($name) && $name == "") echo "<p class=error>Введите название темы</p>";
else if (isset($name) && $name != "")
{
    $c = 1;
    $update_ = mysql_query("UPDATE theme set name='$name' where id_theme=".$theme."");
    echo "<p class=create>Тема успешно изменена</p>";
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewforum.php?t='.$t.'\"",1000);</script>'; 

}
if (isset($theme) && $c != 1)
{
echo "<center><form action=change_theme.php?s=".$theme."&t=".$t." method=post>Введите название темы
    <br><textarea name=name cols=50>";
    do 
    {
       echo $selected_theme_a['name'];
    }
    while ($selected_theme_a = mysql_fetch_array($selected_theme));
   echo "</textarea><br><br><input type=submit value='Изменить'></form></center>";
   }

include "footer.php";

?>