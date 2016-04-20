<?php
include "config/config.php";
include "header.php";
include "menu.php";
$datetime = date("Y-m-d H:i:s");
$id_private = $_GET['id_private'];
if ($_GET['mess'] == "inbox")
{
$update_read = mysql_query("UPDATE private_messages_inbox set read_='1' where id_private_messages = ".$id_private."");
$selected_user_private_mess = mysql_query("SELECT * FROM private_messages_inbox where id_private_messages = ".$id_private."");
$selected_user_private_mess_a = mysql_fetch_array($selected_user_private_mess);
}
else
{
$selected_user_private_mess = mysql_query("SELECT * FROM private_messages_outbox where id_private_messages = ".$id_private."");
$selected_user_private_mess_a = mysql_fetch_array($selected_user_private_mess);
}
$select_send_user = mysql_query("SELECT * FROM users where id_user = ".$selected_user_private_mess_a['id_user_send']."");
$select_send_user_a = mysql_fetch_array($select_send_user);
$select_get_user = mysql_query("SELECT * FROM users where id_user = ".$selected_user_private_mess_a['id_user_get']."");
$select_get_user_a = mysql_fetch_array($select_get_user);
$id_user = $_GET['id_user'];
$text = $_POST['text'];


if (!isset($_GET['id_user']))
{
do
{
        $text_1 = str_replace("[","<",$selected_user_private_mess_a['text']);
    $text_2 = str_replace("[/","</",$text_1);
    $text_ = str_replace("]",">",$text_2);
    $text_ = str_replace("<URL=","<a href=",$text_);
    $text_ = str_replace("</URL>","</a>",$text_);
    $text_ = str_replace("<img>","<img src=>",$text_);
    $quote_ = "|<quote user=(\w*)>|i";
    $text_ = preg_replace($quote_,"<div class='quote'><div class='quote2'>Сообщение от  <span style=color:red>$1</span><hr></div><pre>",$text_);
    $text_ = str_replace("</quote>","</pre></div>",$text_);
    $p = "|:([a-z]*):|i";
    $pr = preg_match_all($p,$text_,$a);
    for ($i=0; $i < count($a[1]);$i++)
    {
        $s = "|:".$a[1][$i].":|";
        $ss = preg_replace($s,"<img src='images/smiles/".$a[1][$i].".gif'>",$text_);
        $text_=$ss;
    }
    $text_ = str_replace("\n","<br>",$text_);
    
    echo "От кого -  <span class='user_send_private'>".$select_send_user_a['login']."</span><br>";
    echo "Кому - <span class='user_send_private'>".$select_get_user_a['login']."</span><br>";
    echo "Добавлено - ".$selected_user_private_mess_a['data']."<br>";
    echo "Тема -  <span class='theme_private'>".$selected_user_private_mess_a['theme']."</span><br>";
    echo "<center>Сообщение </center><hr><table><tr><td width=100% class='sms'>".$text_."</td></tr></table><br><hr>";////////
}
while ($selected_user_private_mess_a = mysql_fetch_array($selected_user_private_mess));
}



if ((!isset($text) || $text == "") && $_GET['i'] != 1 )
{
    $selected_user_private_mess = mysql_query("SELECT * FROM private_messages_inbox where id_private_messages = ".$id_private."");
$selected_user_private_mess_a = mysql_fetch_array($selected_user_private_mess);
echo "<table><tr><td class='vote_word'>Быстрый ответ</td></tr></table>";
echo "<form method='POST' action='read_privates.php?id_user=".$select_send_user_a['id_user']."&theme=".$selected_user_private_mess_a['theme']."'><center>
<BR>Введите текст сообщения<br>";
include "format_text.php";
include "smiles.php";
echo "<textarea name='text' id='message' cols=80 rows=15></textarea><br><br>
<input type='submit' value='Отправить'>
</center></form>";
}
else
if (isset($text) && $text != "" && $_GET['i'] != 1)
{
    
    $add_mess_inbox = mysql_query("INSERT INTO private_messages_inbox(id_user_send,id_user_get,theme,text,data,read_) values('".$_SESSION['id_user']."','".$id_user."','".$_GET['theme']."','".$text."','".$datetime."','0')");
    $add_mess_outbox = mysql_query("INSERT INTO private_messages_outbox(id_user_send,id_user_get,theme,text,data,read_) values('".$_SESSION['id_user']."','".$id_user."','".$_GET['theme']."','".$text."','".$datetime."','1')");
    
    //$add_mess_outbox = mysql_query("INSERT INTO private_messages_outbox(id_user_send,id_user_get,theme,text,data,read_) values('".$_SESSION['id_user']."','".$selected_user_private_mess_get_a['id_user']."','".$theme."','".$text."','".$datetime."','1')");
   // $add_mess_inbox = mysql_query("INSERT INTO private_messages_inbox(id_user_send,id_user_get,theme,text,data,read_) values('".$_SESSION['id_user']."','".$selected_user_private_mess_get_a['id_user']."','".$theme."','".$text."','".$datetime."','0')");
 echo "INSERT INTO private_messages_inbox(id_user_send,id_user_get,theme,text,data,read_) values('".$_SESSION['id_user']."','".$id_user."','".$_GET['theme']."','".$text."','".$datetime.",'0'')";
  echo "<p class='create'>Сообщение успешно отправлено</p>";
  //echo '<script language="JavaScript">var f = setTimeout("window.location=\"privates.php?mess=outbox\"",1000);</script>';
}

include "footer.php";
?>