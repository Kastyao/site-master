<?php
session_start();
include "config/config.php";
$datetime = date("Y-m-d H:i:s");
$user = mysql_query("UPDATE users set last_enter=now() where id_user=".$_SESSION['id_user'].";");
$str = "";
$show_user = mysql_query("SELECT * FROM users WHERE adddate(now(),interval -1 minute) < last_enter");
$show_user_a = mysql_fetch_array($show_user);
do
{
    $str = $str.";".$show_user_a['login'];
    
}
while ($show_user_a = mysql_fetch_array($show_user));
//echo $str;
$offline = mysql_query("UPDATE users set online=0 where adddate(now(),interval -1 minute) >= last_enter");
$online = mysql_query("UPDATE users set online=1 where adddate(now(),interval -1 minute) <= last_enter");



?>