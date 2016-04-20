<?php
session_start();
error_reporting(0);
include "config/config.php";
include "header.php";
include "menu.php";
$id_user = $_GET['id_user'];
$show_users = mysql_query("SELECT * FROM users");
$show_users_a = mysql_fetch_array($show_users);

$selected_user = mysql_query("SELECT * from users where id_user='$id_user'");
$selected_user_a = mysql_fetch_array($selected_user);

echo "<script language='JavaScript'>
function ban()
{
location.href='ban.php?id_user=".$selected_user_a['id_user']."&i=1';
}
function noban()
{
location.href='admin.php';
}
</script>";

if (!isset($id_user))
do
{
    if ($show_users_a['ban'] == 1 && $show_users_a['login'] != "admin")
     echo "<a href='unban.php?id_user=".$show_users_a['id_user']."'>".$show_users_a['login']."</a><br>";
}
while ($show_users_a = mysql_fetch_array($show_users));

if (isset($id_user))
{

    $ban = mysql_query("UPDATE users set ban=0 where id_user='$id_user'");
    echo "<p class=create>Пользователь разабанен</p>";
                echo '<script language="JavaScript">var f = setTimeout("window.location=\"admin.php\"",1000);</script>';

}

include "footer.php";
?>