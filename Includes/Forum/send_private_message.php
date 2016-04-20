<?php
error_reporting(0);
$id = $_GET['t'];
$i = $_GET['page'];
$k = $_GET['k'];
$g = $_GET['g'];
$s = $_GET['s'];
include "config/config.php";
include "header.php";
include "menu.php";
if (!isset($_GET['i']))
{
$id_user = $_GET['id_user'];
$text = $_POST['text'];
$theme = $_POST['theme'];
$datetime = date("Y-m-d H:i:s");
if ($theme == "" && isset($theme)) echo "<p class='error'>Введите тему сообщения</p>";
else if ($text == "" && isset($text)) echo "<p class='error'>Введите сообщение</p>";

if (!isset($text) || $text == "" || !isset($theme) || $theme == "")
{
echo "<form method='POST' action='send_private_message.php?id_user=".$id_user."&g=".$g."&s=".$s."&t=".$id."&page=".$page."&k=".$k."&idd=".$_GET['idd']."'><center>
Введите тему сообщения <br><br><input type='text' name='theme'><br><br>
Введите текст сообщения<br>";
include "format_text.php";
include "smiles.php";
echo "<textarea name='text' id='message' cols=80 rows=15 ></textarea><br><br>
<input type='submit' value='Отправить'>
</center></form>";
}
else
if (isset($theme) && $theme != "" && isset($text) && $text != "")
{
    $add_mess_outbox = mysql_query("INSERT INTO private_messages_outbox(id_user_send,id_user_get,theme,text,data,read_) values('".$_SESSION['id_user']."','".$id_user."','".$theme."','".$text."','".$datetime."','1')");
    $add_mess_inbox = mysql_query("INSERT INTO private_messages_inbox(id_user_send,id_user_get,theme,text,data,read_) values('".$_SESSION['id_user']."','".$id_user."','".$theme."','".$text."','".$datetime."','0')");
  echo "<p class='create'>Сообщение успешно отправлено</p>";
 if ($_GET['idd'] != 1) echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?g='.$g.'&s='.$s.'&t='.$id.'&page='.$k.'&k='.$k.'\"",1000);</script>';
 else echo '<script language="JavaScript">var f = setTimeout("window.location=\"privates.php?mess=outbox\"",1000);</script>';
}
}
else

///////////////////////
if ($_GET['i'] == 1)
{
    
$text = $_POST['text'];
$theme = $_POST['theme'];
$datetime = date("Y-m-d H:i:s");
$login_user_send = $_POST['user'];
$selected_user_private_mess_get = mysql_query("SELECT * FROM users where login like '".$login_user_send."'");
$selected_user_private_mess_get_a = mysql_fetch_array($selected_user_private_mess_get);

if ($theme == "" && isset($theme)) echo "<p class='error'>Введите тему сообщения</p>";
else if ($text == "" && isset($text)) echo "<p class='error'>Введите сообщение</p>";
else if (isset($login_user_send) && mysql_num_rows($selected_user_private_mess_get) == 0) echo "<p class='error'>Такого пользователя не существует</p>";

if (!isset($text) || $text == "" || !isset($theme) || $theme == "" || mysql_num_rows($selected_user_private_mess_get) == 0)
{
echo "<form method='POST' action='send_private_message.php?i=1'><center>
Введите имя пользователя<br><br><input type='text' name='user'><br><br>
Введите тему сообщения<br><input type='text' name='theme'><br><br>
Введите текст сообщения<br>";
include "format_text.php";
include "smiles.php";
echo "<textarea name='text' id='message' cols=80 rows=15 ></textarea><br><br>
<input type='submit' value='Отправить'>
</center></form>";
}
else
if (isset($theme) && $theme != "" && isset($text) && $text != "" && mysql_num_rows($selected_user_private_mess_get) > 0)
{
    $add_mess_outbox = mysql_query("INSERT INTO private_messages_outbox(id_user_send,id_user_get,theme,text,data,read_) values('".$_SESSION['id_user']."','".$selected_user_private_mess_get_a['id_user']."','".$theme."','".$text."','".$datetime."','1')");
    $add_mess_inbox = mysql_query("INSERT INTO private_messages_inbox(id_user_send,id_user_get,theme,text,data,read_) values('".$_SESSION['id_user']."','".$selected_user_private_mess_get_a['id_user']."','".$theme."','".$text."','".$datetime."','0')");
  echo "<p class='create'>Сообщение успешно отправлено</p>";
  echo '<script language="JavaScript">var f = setTimeout("window.location=\"privates.php?mess=inbox\"",1000);</script>';
}
    
}

include "footer.php";
?>