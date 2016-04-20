<?php
//error_reporting(0);
include "config/config.php";
include "header.php";
include "menu.php";

//g=1&s=2&t=9&page=0&k=0
$select_rep_mess = mysql_query("SELECT * FROM reputation where id_user_send_reputation=".$_SESSION['id_user']." and id_message=".$_GET['id_mess']."");
if (mysql_num_rows($select_rep_mess) > 0 )
{
    echo "<p class='create'>Вы уже влияли на репутацию этого пользователя</p>";
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?g='.$_GET['g'].'&s='.$_GET['s'].'&t='.$_GET['t'].'&page='.$_GET['page'].'&k='.$_GET['k'].'\"",1000);</script>';
}
else if ($_SESSION['id_user'] == $_GET['id_user'])
{
    echo "<p class='create'>Нельзя влиять себе на репутацию</p>";
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?g='.$_GET['g'].'&s='.$_GET['s'].'&t='.$_GET['t'].'&page='.$_GET['page'].'&k='.$_GET['k'].'\"",1000);</script>';
}
else
{
if (isset($_GET['i']) && ($_GET['i'] == 0 || $_GET['i'] == 1) && !isset($_GET['b']))
echo "<center><form method=POST action='reputation.php?b=0&i=".$_GET['i']."&id_mess=".$_GET['id_mess']."&id_user=".$_GET['id_user']."&g=".$_GET['g']."&s=".$_GET['s']."&t=".$_GET['t']."&page=".$_GET['page']."&k=".$_GET['k']."'>Введите комментарий<br><br><textarea name='comment' cols=80 rows=15></textarea><br><br><input type='submit' value='Отправить'></form></center>";

if ($_GET['i'] == 1 && !isset($_GET['a']))
{
    $add_reputation = mysql_query("INSERT INTO reputation(id_user_send_reputation,id_user_get_reputation,id_message,comment,rep) VALUES('".$_SESSION['id_user']."','".$_GET['id_user']."','".$_GET['id_mess']."','".$_POST['comment']."','1')");
    $update_reputation_user = mysql_query("UPDATE users set reputation=reputation+1");
    echo "<p class='create'>Вы успешно повлияли на репутацию пользователя</p>";
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?g='.$_GET['g'].'&s='.$_GET['s'].'&t='.$_GET['t'].'&page='.$_GET['page'].'&k='.$_GET['k'].'\"",1000);</script>';
}
else if ($_GET['i'] == 0 && !isset($_GET['a']))
{
    $add_reputation = mysql_query("INSERT INTO reputation(id_user_send_reputation,id_user_get_reputation,id_message,comment,rep) VALUES('".$_SESSION['id_user']."','".$_GET['id_user']."','".$_GET['id_mess']."','".$_POST['comment']."','-1')");
    $update_reputation_user = mysql_query("UPDATE users set reputation=reputation-1");
    echo "<p class='create'>Вы успешно повлияли на репутацию пользователя</p>";
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?g='.$_GET['g'].'&s='.$_GET['s'].'&t='.$_GET['t'].'&page='.$_GET['page'].'&k='.$_GET['k'].'\"",1000);</script>';
}
}
include "footer.php";

?>