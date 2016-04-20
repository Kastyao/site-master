<?php
include "config/config.php";
include "header.php";
include "menu.php";
$theme = $_GET['s'];
$t = $_GET['t'];
$selected_theme = mysql_query("SELECT * from theme where id_theme='$theme'");
$selected_theme_a = mysql_fetch_array($selected_theme);
echo "<script language='JavaScript'>
function delete_()
{
location.href='delete_theme.php?s=".$selected_theme_a['id_theme']."&i=1&t=".$t."';
}
function nodelete_()
{
location.href='admin.php';
}
</script>";
if (!isset($_GET['i']))
echo "<center><form method='POST'>Вы уверены что хотите удалить раздел <h2>".$selected_theme_a['name']."</h2>
<br><input type=button value='ДА' onclick=\"delete_()\">
<input type=button value='НЕТ' onclick=\"nodelete_()\"></form></center>";

if (isset($_GET['i']) && $_GET['i'] == 1)
{
    $delete = mysql_query("DELETE from theme where id_theme='$theme'");
    $delete_sub_theme = mysql_query("DELETE from sub_theme where id_theme='$theme'");
    $delete_mess = mysql_query("DELETE from message where id_sub_theme not in(SELECT id_sub_theme from sub_theme)");
    echo "<p class=create>Тема успешно удалена</p>";
                echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewforum.php?t='.$t.'\"",1000);</script>';
}
include "footer.php";
?>