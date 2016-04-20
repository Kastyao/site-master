<?php
include "config/config.php";
include "header.php";
include "menu.php";
$global_theme = $_GET['t'];
$selected_global_theme = mysql_query("SELECT * from global_theme where id_global_theme='$global_theme'");
$selected_global_theme_a = mysql_fetch_array($selected_global_theme);
echo "<script language='JavaScript'>
function delete_()
{
location.href='delete_global_theme.php?t=".$selected_global_theme_a['id_global_theme']."&i=1';
}
function nodelete_()
{
location.href='index.php';
}
</script>";
if (!isset($_GET['i']))
echo "<center><form method='POST'>Вы уверены что хотите удалить раздел <h2>".$selected_global_theme_a['name']."</h2>
<br><input type=button value='ДА' onclick=\"delete_()\">
<input type=button value='НЕТ' onclick=\"nodelete_()\"></form></center>";

if (isset($_GET['i']) && $_GET['i'] == 1)
{
    $select_deleted_theme = mysql_query("SELECT * from theme where id_global_theme='$global_theme'");
    $select_deleted_theme_a = mysql_fetch_array($select_deleted_theme);
    $select_deleted_sub_theme = mysql_query("SELECT * from sub_theme where id_theme=".$select_deleted_theme_a['id_theme']."");
    $select_deleted_sub_theme_a = mysql_fetch_array($select_deleted_sub_theme);
    
    $delete_global_theme = mysql_query("DELETE from global_theme where id_global_theme='$global_theme'");
    
    $delete_theme = mysql_query("DELETE from theme where id_global_theme='$global_theme'");
    
    $delete_sub_theme = mysql_query("DELETE from sub_theme where id_theme=".$select_deleted_theme_a['id_theme']."");
    
    $delete_mess = mysql_query("DELETE from message where id_sub_theme=".$select_deleted_sub_theme_a['id_sub_theme']."");
    echo "<p class=create>Раздел успешно удалён</p>";
                echo '<script language="JavaScript">var f = setTimeout("window.location=\"index.php\"",1000);</script>';
}
include "footer.php";
?>