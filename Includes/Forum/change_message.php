<?php
include "config/config.php";
include "header.php";
include "menu.php";
$sub_theme = $_GET['t'];
$id_message = $_GET['mess'];
$id_user = $_GET['id_user'];
$message = $_POST['message'];
$page = $_GET['page'];
$g = $_GET['g'];
$s = $_GET['s'];
$k = $_GET['k'];
$selected_message = mysql_query("SELECT * from message where id_message='$id_message'");
$selected_message_a = mysql_fetch_array($selected_message);

$text = str_replace("'","\'",$message);

if (isset($message) && $message== "") echo "<script>alert('Необходимо ввести текст сообщения');window.location = 'change_message.php?t=".$sub_theme."&mess=".$id_message."&page=".$page."';</script>";

if (isset($message) && $message != "")
{
    $c = 1;
    $add_message = mysql_query("UPDATE message set text='$text' where id_message='$id_message'");
}

if (!isset($message) && $c != 1)
{

echo "<br>";
include "format_text.php";
include "smiles.php";
echo "<center><form method='POST' action='change_message.php?g=".$g."&s=".$s."&k=".$k."&t=".$sub_theme."&mess=".$id_message."&page=".$page."'>
<textarea cols=80 rows=15 name='message' id='message'>".$selected_message_a['text']."</textarea><br><br>
<input type='submit' value='Изменить'>
</form></center><br>";

}

if ($add_message) $c = 1;

if ($c == 1) 
{

    echo "<p class=create>Сообщение изменено</p>";
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?g='.$g.'&s='.$s.'&k='.$k.'&t='.$sub_theme.'&page='.$page.'\"",1000);</script>'; 

}

include "footer.php";

?>