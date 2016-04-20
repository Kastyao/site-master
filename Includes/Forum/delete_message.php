<?php
include "config/config.php";
include "header.php";
include "menu.php";
$sub_theme = $_GET['t'];
$message = $_GET['mess'];
$id_user = $_GET['id_user'];
$page = $_GET['page'];
$g = $_GET['g'];
$s = $_GET['s'];
$k = $_GET['k'];

$selected_message = mysql_query("SELECT * from message where id_sub_theme='$sub_theme' && id_user='$id_user'");
$selected_message_a = mysql_fetch_array($selected_message);

$delete_user_mess = mysql_query("SELECT * from users where id_user='$id_user'");
$delete_user_mess = mysql_fetch_array($delete_user_mess);


echo "<script language='JavaScript'>
function delete_()
{
location.href='delete_message.php?g=".$g."&s=".$s."&k=".$k."&t=".$sub_theme."&mess=".$message."&id_user=".$id_user."&i=1&page=".$page."';
}
function nodelete_()
{
location.href='viewtopic.php?t=".$sub_theme."';
}
</script>";
if (!isset($_GET['i']))
echo "<center><form method='POST'>Вы уверены что хотите удалить это сообщение ?
<br><input type=button value='ДА' onclick=\"delete_()\">
<input type=button value='НЕТ' onclick=\"nodelete_()\"></form></center>";

if (isset($_GET['i']) && $_GET['i'] == 1)
{
    $delete = mysql_query("DELETE from message where id_message='$message'");
    $delete_user_mess_ = mysql_query("UPDATE users set texts=texts-1 where id_user='$id_user'");
    
    echo "<p class=create>Сообщение успешно удалено</p>";
                echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?g='.$g.'&s='.$s.'&k='.$k.'&t='.$sub_theme.'&page='.$page.'\"",1000);</script>';
}
include "footer.php";
?>