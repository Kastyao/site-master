<?php
include "config/config.php";
include "header.php";
include "menu.php";

$sub_theme = $_GET['t'];

$open_sub_theme = mysql_query("SELECT * FROM sub_theme where id_sub_theme = ".$sub_theme."");
$open_sub_theme_a = mysql_fetch_array($open_sub_theme);

echo "<script language='JavaScript'>
function delete_()
{
location.href='open_sub_theme.php?t=".$open_sub_theme_a['id_sub_theme']."&i=1';
}
function nodelete_()
{
location.href='viewtopic.php?t=".$open_sub_theme_a['id_sub_theme']."';
}
</script>";
if (!isset($_GET['i']))
echo "<center><form method='POST'>Вы уверены что хотите закрыть подтему <h2>".$open_sub_theme_a['name']."</h2>
<br><input type=button value='ДА' onclick=\"delete_()\">
<input type=button value='НЕТ' onclick=\"nodelete_()\"></form></center>";

if (isset($_GET['i']) && $_GET['i'] == 1)
{
    $close = mysql_query("UPDATE sub_theme set locked=0 where id_sub_theme='$sub_theme'");
    //$delete_mess = mysql_query("DELETE from message where id_sub_theme not in(SELECT id_sub_theme from sub_theme)");
    echo "<p class=create>Подтема открыта</p>";
                echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?t='.$sub_theme.'\"",1000);</script>';
}
include "footer.php";
?>