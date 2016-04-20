<?php
include "config/config.php";
include "header.php";
include "menu.php";
$sub_theme = $_GET['t'];
$s = $_GET['s'];
$g = $_GET['g'];

$selected_sub_theme = mysql_query("SELECT * from sub_theme where id_sub_theme='$sub_theme'");
$selected_sub_theme_a = mysql_fetch_array($selected_sub_theme);
echo "<script language='JavaScript'>
function delete_()
{
location.href='delete_sub_theme.php?g=".$g."&t=".$selected_sub_theme_a['id_sub_theme']."&i=1&s=".$s."';
}
function nodelete_()
{
location.href='viewforum.php?t=".$g."&s=".$s."';
}
</script>";
if (!isset($_GET['i']))
echo "<center><form method='POST'>Вы уверены что хотите удалить раздел <h2>".$selected_sub_theme_a['name']."</h2>
<br><input type=button value='ДА' onclick=\"delete_()\">
<input type=button value='НЕТ' onclick=\"nodelete_()\"></form></center>";

if (isset($_GET['i']) && $_GET['i'] == 1)
{
    $delete = mysql_query("DELETE from sub_theme where id_sub_theme='$sub_theme'");
    $delete_mess = mysql_query("DELETE from message where id_sub_theme not in(SELECT id_sub_theme from sub_theme)");
    $delete_vote_id_sub_theme = mysql_query("DELETE from vote_id_sub_theme where id_sub_theme = '$sub_theme'");
    $delete_vote_answer = mysql_query("DELETE from vote_answer,vote_id_sub_theme where vote_id_sub_theme.id_sub_theme = '$sub_theme' and vote_answer.id_vote_id_sub_theme = vote_id_sub_theme.id_vote_id_sub_theme");
    $delete_vote_answer_user = mysql_query("DELETE FROM vote_id_sub_theme,vote_answer,vote_answer_user where vote_id_sub_theme.id_sub_theme = '$sub_theme' and vote_answer.id_vote_id_sub_theme = vote_id_sub_theme.id_vote_id_sub_theme and vote_answer.id_vote_answer = vote_answer_user.id_vote_answer");
    echo "<p class=create>Подтема успешно удалена</p>";
                echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewforum.php?t='.$g.'&s='.$s.'\"",1000);</script>';
}
include "footer.php";
?>