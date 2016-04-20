<?php
include "config/config.php";
include "header.php";
include "menu.php";
$sub_theme = $_GET['t'];
$g = $_GET['g'];
$s = $_GET['s'];

$selected_sub_theme = mysql_query("SELECT * from sub_theme where id_sub_theme='$sub_theme'");
$selected_sub_theme_a = mysql_fetch_array($selected_sub_theme);
$name = $_POST['name'];
if (isset($name) && $name == "") echo "<p class=error>Введите название подтемы</p>";
else if (isset($name) && $name != "")
{
    $c = 1;
    $update_ = mysql_query("UPDATE sub_theme set name='".$name."' where id_sub_theme=".$sub_theme."");
    echo "<p class=create>Тема успешно изменена</p>";
 
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewforum.php?t='.$g.'&s='.$s.'\"",1000);</script>'; 

}
if (isset($sub_theme) && $c != 1)
{
echo "<center><form action='change_sub_theme.php?t=".$sub_theme."&s=".$s."&g=".$g."' method=post>Введите название темы
    <br><textarea name='name' cols=50>";
    do 
    {
       echo $selected_sub_theme_a['name'];
    }
    while ($selected_sub_theme_a = mysql_fetch_array($selected_sub_theme));
   echo "</textarea><br><br><input type=submit value='Изменить'></form></center>";
}
include "footer.php";

?>