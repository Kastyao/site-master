<?php
include "config/config.php";
include "header.php";
include "menu.php";
$global_theme = $_GET['t'];
$selected_global_theme = mysql_query("SELECT * from global_theme where id_global_theme='$global_theme'");
$selected_global_theme_a = mysql_fetch_array($selected_theme);
$name = $_POST['name'];
$hidden_theme = $_POST['hidden'];
if ($hidden_theme == "on") $hidden = 1;
else $hidden = 0;
if (isset($name) && $name == "") echo "<p class=error>Введите новое название раздела</p>";
else if (isset($name) && $name != "")
{
    $c = 1;
    $update_ = mysql_query("UPDATE global_theme set name='$name',hidden='$hidden' where id_global_theme=".$global_theme."");
    echo "<p class=create>Тема успешно изменена</p>";
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"index.php\"",1000);</script>'; 

}
if (isset($global_theme) && $c != 1)
{
echo "<center><form action=change_global_theme.php?t=".$global_theme." method=post>Введите новое название раздела
    <br><textarea name=name cols=50>";
    do 
    {
       echo $selected_global_theme_a['name'];
    }
    while ($selected_global_theme_a = mysql_fetch_array($selected_global_theme));
   echo "</textarea><br><br>
   <input type=checkbox name='hidden'>  Видна только модераторам<br> 
   <input type=submit value='Изменить'></form></center>";
   }

include "footer.php";

?>