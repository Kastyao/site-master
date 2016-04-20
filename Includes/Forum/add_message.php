<?php
session_start();
error_reporting(0);
include "config/config.php";
$id = $_GET['t'];
$i = $_GET['page'];
$k = $_GET['k'];
$g = $_GET['g'];
$s = $_GET['s'];
$c = 0;

$file = $HTTP_POST_VARS['file_'];
$file_name = $_FILES['file_']['name'];
$file_size = $_FILES['file_']['size'];
$file_type = $_FILES['file_']['type'];
$file_tmp = $_FILES['file_']['tmp_name'];

if ($_SESSION['enter'] == 1 && $c == 0)
{

$select_user = mysql_query("SELECT * from users where login like '%".$_SESSION['username']."%'");
$select_user_a = mysql_fetch_array($select_user);

$user_messages = mysql_query("SELECT * from users");
$user_messages_a = mysql_fetch_array($user_messages);

$status = mysql_query("SELECT * from users where id_user=".$select_user_a['id_user']."");
$status_a = mysql_fetch_array($status);

$message = $_POST['message'];
$datetime = date("Y-m-d H:i:s");
$text = str_replace("'","\'",$message);

if (isset($message) && $message == "") echo "<script>alert('Необходимо ввести текст сообщения');window.location = 'viewtopic.php?g=".$g."&s=".$s."&t=".$id."&page=".$i."&k=".$k."';                                                </script>";

if (isset($message) && $message != "")
{
    
    $add_message = mysql_query("INSERT into message(id_sub_theme,id_user,text,file,data) VALUES('$id','".$select_user_a['id_user']."','$text','$file_name','$datetime')");
    $add_user_message = mysql_query("UPDATE users set texts=texts+1 where login like '%".$_SESSION['username']."%'");
    if ($file_name != "") move_uploaded_file($file_tmp, 'files/'.$file_name);
    if ($status_a['texts'] >= 50) $update_status = mysql_query("UPDATE users set status='Посетитель' where login like '%".$_SESSION['username']."%'");
    if ($status_a['texts'] >= 100) $update_status = mysql_query("UPDATE users set status='Участник' where login like '%".$_SESSION['username']."%'");
    if ($status_a['texts'] >= 500) $update_status = mysql_query("UPDATE users set status='Активист' where login like '%".$_SESSION['username']."%'");
    if ($status_a['texts'] >= 1000) $update_status = mysql_query("UPDATE users set status='Гуру' where login like '%".$_SESSION['username']."%'");
}

if (!isset($message))
{

echo "<br><table><tr><td class='fast_answer'>Быстрый ответ</td></tr></table><br>";
include "format_text.php";
include "smiles.php";
echo "<center><form name='f1' enctype='multipart/form-data' method='POST' action='add_message.php?g=".$g."&s=".$s."&t=".$id."&page=".$k."&k=".$k."'>
<textarea cols=80 rows=15 name='message' id='message'></textarea><br><br>
<a id='add_file' class=error>Прикрепить файл</a>
<span id='add_file_' style=display:none><br>
<span class='error'>Можно приклеплять файлы размером до 2мб</span>
<br><input type=file name='file_'><br>
</span>
<br><br><input type='submit' value='Отправить'>
</form></center><br>";
     echo " <script src='jquery-latest.js'></script>
  <script>

  $('#add_file').click(function(){
    $('#add_file_').slideToggle(1000);
  });
  
  </script>";
}
       
if ($add_message) $c = 1;
}
if ($c == 1) 
{
    include "header.php";
    include "menu.php";
    echo "<p class=create>Сообщение отправлено</p>";
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?g='.$g.'&s='.$s.'&t='.$id.'&page='.$k.'&k='.$k.'&r=1\"",1000);</script>'; 
    include "footer.php";
}


?>
