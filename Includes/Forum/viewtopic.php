<?php

include "config/config.php";
include "header.php";
include "menu.php";
include "check_online.php";

$topic = $_GET['t'];
$k_ = $_GET['k'];
$global = $_GET['g'];

$selected_global_theme = mysql_query("SELECT * FROM global_theme where id_global_theme = ".$_GET['g']."");
$selected_global_theme_a = mysql_fetch_array($selected_global_theme);

$selected_theme = mysql_query("SELECT * from theme where id_theme = ".$_GET['s']."");
$selected_theme_a = mysql_fetch_array($selected_theme);

$selected_sub_theme = mysql_query("SELECT * FROM sub_theme where id_sub_theme = ".$topic."");
$selected_sub_theme_a = mysql_fetch_array($selected_sub_theme);

    echo "<a href='index.php'>Форум</a>->";
    echo "<a href='viewforum.php?t=".$selected_global_theme_a['id_global_theme']."'>".$selected_global_theme_a['name']."</a>";
    echo "->";
    echo "<a href='viewforum.php?s=".$_GET['s']."&t=".$_GET['g']."'>".$selected_theme_a['name']."</a>";
    echo "-><a href='viewtopic.php?g=".$_GET['g']."&s=".$_GET['s']."&t=".$topic."&page=0&k=".$k_."'>".$selected_sub_theme_a['name']."</a>";

if (isset($_GET['add']))
{
    $add_watching = mysql_query("UPDATE sub_theme set watchings=watchings+1 where id_sub_theme=".$topic."");
    unset($_GET['add']);
    echo "<script language=JavaScript>window.location = 'viewtopic.php?g=".$_GET['g']."&s=".$_GET['s']."&t=".$topic."&page=0&k=".$k_."';</script>";
}


$selected_sub_theme_vote = mysql_query("SELECT count(vote_answer.answer) as c FROM vote_id_sub_theme,vote_answer where vote_id_sub_theme.id_sub_theme = ".$topic." and vote_answer.id_vote_id_sub_theme = vote_id_sub_theme.id_vote_id_sub_theme");
$selected_sub_theme_vote_a = mysql_fetch_array($selected_sub_theme_vote); 

$selected_vote = mysql_query("SELECT * FROM vote_id_sub_theme,vote_answer where vote_id_sub_theme.id_sub_theme = ".$topic." and vote_answer.id_vote_id_sub_theme = vote_id_sub_theme.id_vote_id_sub_theme");
$selected_vote_a = mysql_fetch_array($selected_vote); 

$check_user_vote = mysql_query("SELECT count(vote_answer_user.id_vote_answer) as c FROM vote_answer_user,vote_answer,vote_id_sub_theme where vote_answer_user.id_vote_answer = vote_answer.id_vote_answer and vote_id_sub_theme.id_sub_theme = ".$topic." and vote_answer.id_vote_id_sub_theme = vote_id_sub_theme.id_vote_id_sub_theme and vote_answer_user.id_user = ".$_SESSION['id_user']."");
$check_user_vote_a = mysql_fetch_array($check_user_vote);

$check_votes = mysql_query("SELECT count(answer) FROM vote_answer_user,vote_answer,vote_id_sub_theme where vote_answer_user.id_vote_answer = vote_answer.id_vote_answer and vote_id_sub_theme.id_sub_theme = ".$topic." and vote_answer.id_vote_id_sub_theme = vote_id_sub_theme.id_vote_id_sub_theme");
$check_votes_a = mysql_fetch_array($check_votes);
/////////////////////////////
$check_ = mysql_query("SELECT * FROM vote_answer,vote_answer_user,vote_id_sub_theme where vote_id_sub_theme.id_sub_theme = ".$topic." and vote_answer.id_vote_answer = vote_answer_user.id_vote_answer and vote_answer.answer like ".$check_votes_a['answer']."");
$check_a_ = mysql_fetch_array($check_);
/////////////////////////////////////////////////
$ch = mysql_query("SELECT vote_answer.answer,count(vote_answer_user.id_vote_answer) as c from vote_id_sub_theme natural join vote_answer natural left join vote_answer_user where vote_id_sub_theme.id_sub_theme = ".$topic." group by vote_answer.id_vote_answer");
$ch_a = mysql_fetch_array($ch);
$n = $selected_sub_theme_vote_a['c'];
if ($n == 0) $n = 1;

do
{
    echo $check_votes_a['answer'];
}
while ($check_votes_a = mysql_fetch_array($check_votes));


///////////////////////////////

if (mysql_num_rows($selected_vote) != 0)
{
    echo "<table><tr><td class='vote_word'>Опрос</td></tr></table>";
    if ($check_user_vote_a['c'] != 0 || $_SESSION['enter'] != 1)
    { 
        echo "<center>Тема голосования - <span class='error'>".$selected_vote_a['vote_name']."</span></center>";
   echo "<table><tr><td class='begin_table_vote'>Вариант</td><td class='begin_table_mess_vote'>Кол-во ответов</td></tr></table>";    
do
{
    $papa = $ch_a['c'];
    
    
    echo "<table class='vote_past'>
    <tr>
    <td width=100% class='vote_past'>".$ch_a['answer']."</td><td class='img_'><img align=middle src='images/line.gif' width='".round(200*$papa/$n)."'>&nbsp;&nbsp;&nbsp;".$ch_a['c']."</td></tr></table>";
    
}
while ($ch_a = mysql_fetch_array($ch));
    }
    else  if ($check_user_vote_a['c'] == 0)
{ 
    echo "<center>Тема голосования - <span class='error'>".$selected_vote_a['vote_name']."</span></center>";
do
{
    echo "<table>
    <tr>
    <td class='vote'>
    <form method=POST action='add_vote.php?g=".$global."&s=".$_GET['s']."&t=".$topic."&page=".$_GET['page']."&k=".$_GET['k']."&id_vote=".$selected_vote_a['id_vote_id_sub_theme']."'>
    <input type=radio name='selected_answer' value='".$selected_vote_a['answer']."'><center>".$selected_vote_a['answer']."</center></td></tr></table>";
}
while ($selected_vote_a = mysql_fetch_array($selected_vote));
echo "<center><br><input type=submit value='Голосовать'></center></form>";
}
}
//if (isset($_GET['mess']))  echo '<script language="JavaScript">var t = setTimeout("window.scrollTo(0,9999)",1000);</script>'; 
$date = date("d");

$today = mysql_query ("SELECT * from message where dayofmonth(date) = '$date' and id_sub_theme ='$topic'");
$yesterday = mysql_query ("SELECT * from message where dayofmonth(data) = '$date'-1 and id_sub_theme ='$topic'");

$month = mysql_query ( "SELECT month(data) from message where id_sub_theme ='$topic'" );
$month_row = mysql_fetch_array ($month);

$time = mysql_query ( "SELECT time(data) from message where id_sub_theme = '$topic'" );
$time_row = mysql_fetch_array ($time);

$year = mysql_query ( "SELECT year(data) from message where id_sub_theme = '$topic'" );
$year_row = mysql_fetch_array ($year);

$day = mysql_query ( "SELECT dayofmonth(data) from message where id_sub_theme = '$topic'" );
$day_row = mysql_fetch_array ($day);

if (mysql_num_rows ($today) != 0)
	$f = 1;
else if (mysql_num_rows ($yesterday) != 0)
	$f = 2;
else
	$f = 3;

$show_smile = mysql_query("SELECT * from smiles");
$show_smile_a[] = mysql_fetch_array($show_smile);

$count_mess = mysql_query("SELECT count(text) as c from message where id_sub_theme ='$topic'");
$count_mess_a = mysql_fetch_array($count_mess);
$count = $count_mess_a['c'];
$k = ceil($count / 10);

if (isset($_GET['page']))
{
		
 $page = $_GET['page'];
 //$str = "SELECT * FROM message order by date desc limit " . ($i * 10) . ',' . (10) . ";";
 $show_mess = mysql_query("SELECT * FROM message where id_sub_theme ='$topic' order by data limit ".($page * 10).','.(10)."");
 $show_mess_a = mysql_fetch_array($show_mess);
} 
else    
{
$show_mess = mysql_query("SELECT * from message where id_sub_theme ='$topic' order by data limit 10");
$show_mess_a = mysql_fetch_array($show_mess);
}
echo "<table><tr><td class='begin_table'>Автор</td><td class='begin_table_mess'>Сообщение</td></tr></table>";
do 
{
  
  //  $show_mess_a['text'] = str_replace("[URL=","<a href=",$show_mess_a['text']);
  //  $show_mess_a['text'] = str_replace("[/URL]","</a>",$show_mess_a['text']);
    
    $text_1 = str_replace("[","<",$show_mess_a['text']);
    $text_2 = str_replace("[/","</",$text_1);
   // $text_3 = str_replace("")
    $text = str_replace("]",">",$text_2);
   // "<img src='","'>","<a href=","</a>",
    $text = str_replace("<URL=","<a href=",$text);
    $text = str_replace("</URL>","</a>",$text);
    $text = str_replace("<img>","<img src=>",$text);
    $show_mess_a['text'] = str_replace("\"","'",$show_mess_a['text']);
   // $text = str_replace("<quote>","<div class='quote'><div class='quote2'>Цитата<hr></div><pre>",$text);
    
    
    //$text = str_replace("<quote user=(.*)>","<div class='quote'><div class='quote2'>Сообщение от<span style=color:red><hr></div><pre>",$text);
    $quote_ = "|<quote user=(\w*)>|i";
    
    $text = preg_replace($quote_,"<div class='quote'><div class='quote2'>Сообщение от  <span style=color:red>$1</span><hr></div><pre>",$text);
    $text = str_replace("</quote>","</pre></div>",$text);
    
    $p = "|:([a-z]*):|i";
    $pr = preg_match_all($p,$text,$a);

    for ($i=0; $i < count($a[1]);$i++)
    {
        $s = "|:".$a[1][$i].":|";
        $ss = preg_replace($s,"<img src='images/smiles/".$a[1][$i].".gif'>",$text);
        $text=$ss;
    }
    $text = str_replace("\n","<br>",$text);
  // if (strpos(":"))
    if ($f == 1)
	$str = "Сегодня, " . $time_row ['time(data)'] . " ";
else if ($f == 2)
	$str = "Вчера, " . $time_row ['time(data)'] . " ";
  
else if ($f == 3) {
	if ($month_row ['month(data)'] == 1)
		$str = " " . $day_row ['dayofmonth(data)'] . " Января  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . "";
	if ($month_row ['month(data)'] == 2)
		$str = " " . $day_row ['dayofmonth(data)'] . " Февраля  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
	if ($month_row ['month(data)'] == 3)
		$str = " " . $day_row ['dayofmonth(data)'] . " Марта  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
	if ($month_row ['month(data)'] == 4)
		$str = " " . $day_row ['dayofmonth(data)'] . " Апреля  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
	if ($month_row ['month(data)'] == '5')
		$str = " " . $day_row ['dayofmonth(data)'] . " Мая  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
	if ($month_row ['month(data)'] == 6)
		$str = " " . $day_row ['dayofmonth(data)'] . " Июня  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
	if ($month_row ['month(data)'] == 7)
		$str = " " . $day_row ['dayofmonth(data)'] . " Июля  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
	if ($month_row ['month(data)'] == 8)
		$str = " " . $day_row ['dayofmonth(data)'] . " Августа  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
	if ($month_row ['month(data)'] == 9)
		$str = " " . $day_row ['dayofmonth(date)'] . " Сентября  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
	if ($month_row ['month(data)'] == 10)
		$str = " " . $day_row ['dayofmonth(data)'] . " Октября  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
	if ($month_row ['month(data)'] == 11)
		$str = " " . $day_row ['dayofmonth(data)'] . " Ноября  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
	if ($month_row ['month(data)'] == 12)
		$str = " " . $day_row ['dayofmonth(data)'] . " Декабря  " . $year_row ['year(data)'] . " " . $time_row ['time(data)'] . " ";
}
    $show_user = mysql_query("SELECT * from users where id_user = ".$show_mess_a['id_user']."");
    $show_user_a = mysql_fetch_array($show_user);
    echo "<script language='javascript' src='java.js'></script>";
    //echo "<table width=100%><tr><td class='info_table_left'>&nbsp;</td><td class='info_table_right'>dsadsa dsa dsads dasd asdsa </td></tr></table>";
    echo "<table class='end_table'><tr><td class='user_mess'><a onClick='write_mess_to(\"".$show_user_a['login']."\");'>".$show_user_a['login']."</a>";
    if ($show_user_a['online'] == 0 && $show_user_a['ban'] == 0) echo "<br><span style='color:red' class='icq'>Offline</span>";
    else if ($show_user_a['online'] == 1 && $show_user_a['ban'] == 0) echo "<br><span style='color:green' class='icq'>Online</span>";
    if ($show_user_a['login'] != "admin" && $show_user_a['ban'] == 0) echo"<br><span class='icq'>".$show_user_a['status']."</span>";
    else if ($show_user_a['ban'] == 1) echo "<br><span class='icq' style='color:red'>Забанен</span>";
    if ($show_user_a['admin'] == 1 && $show_user_a['login'] != "admin" ) echo "<br><span class='icq' style='color:green'>Модератор</span>";
    else if ($show_user_a['login'] == "admin") echo "<br><span class='icq' style='color:red'>Администратор</span>";
    echo "</span><br><img height=99 width=99 src='images/".$show_user_a['avatar']."'><br>";
    if ($show_user_a['icq'] != "") echo "<span class='icq'>ICQ&nbsp;:&nbsp;".$show_user_a['icq']."</span><br>";
    if ($show_user_a['age'] != "") echo "<span class='icq'>Возвраст&nbsp;:&nbsp;".$show_user_a['age']."</span><br>";
    if ($show_user_a['sex'] != "") echo "<span class='icq'>Пол&nbsp;:&nbsp;".$show_user_a['sex']."</span><br>";
    if ($show_user_a['podpis'] != "") echo "<span class='icq'>Обо мне&nbsp;:&nbsp;".$show_user_a['podpis']."</span><br>";
    //echo "<span class='icq'>Репутация:&nbsp;:&nbsp;".$show_user_a['reputation']."</span><br>";
    if ($_SESSION['enter'] == 1) echo "<span class='icq'>Сообщений&nbsp;:&nbsp;".$show_user_a['texts']."<a href='reputation.php?i=1&id_mess=".$show_mess_a['id_message']."&id_user=".$show_user_a['id_user']."&a=0&g=".$_GET['g']."&s=".$_GET['s']."&t=".$_GET['t']."&page=".$_GET['page']."&k=".$_GET['k']."'><img height=25 src='images/angel.png'></a><span class='reputation'>
    ".$show_user_a['reputation']."</span>&nbsp;&nbsp;&nbsp;<a href='reputation.php?i=0&id_mess=".$show_mess_a['id_message']."&id_user=".$show_user_a['id_user']."&a=0&g=".$_GET['g']."&s=".$_GET['s']."&t=".$_GET['t']."&page=".$_GET['page']."&k=".$_GET['k']."'><img height=25 src='images/devil.png'></a><a href='viewprofile.php?user=".$show_user_a['id_user']."'> <img src='images/icon_profile.gif' title='Просмотреть профиль'></a>
    <br><a href='send_private_message.php?id_user=".$show_user_a['id_user']."&g=".$global."&s=".$_GET['s']."&t=".$topic."&page=".$_GET['page']."&k=".$_GET['k']."' title='Написать личное сообщение'><img src='images/icon_pm.gif'></a></span></td>";
    
    echo "<td class='info_table_right'>".$str."<span class='img'>";
    if ($_SESSION['enter'] == 1) echo "<a onClick=add_quote(\"".$show_user_a['login']."\",\"".$show_mess_a['text']."\");><img src='images/icon_quote.gif' title='Цитировать'></a>";
    echo "</span></td><td class='mess'><br>".$text."";
    if ($show_mess_a['file'] != "") 
    {echo "<br><br><br><br><br><br><br><br><br><br><br><br><hr>
    <span class=file_add><img src='images/icon_topic_attach.gif' height=10px>Приклеплённый файл - <a href='files/".$show_mess_a['file']."'>".$show_mess_a['file']."</a>";
    $filesize_ = filesize("files/".$show_mess_a['file']."");
    $filesize2 = $filesize_ / 1024;
    $filesize__ = ceil($filesize2);
    echo " (".$filesize__." кб)";
    //echo " (".(ceil($filesize_ ,1000).") кб";
    echo "</span>";
    echo "</td></tr>";
    }
    if ($_SESSION['moderator'] == 1 || $show_user_a['id_user'] == $_SESSION['id_user']) echo "<tr><td class='user_mess'></td><td class='edit_mess'><a href='change_message.php?g=".$_GET['g']."&s=".$_GET['s']."&k=".$_GET['k']."&t=".$topic."&mess=".$show_mess_a['id_message']."&page=".$page."'><hr><img src='images/icon_edit.gif' title='Править'></a>&nbsp;&nbsp;<a href='delete_message.php?g=".$_GET['g']."&s=".$_GET['s']."&k=".$_GET['k']."&t=".$topic."&mess=".$show_mess_a['id_message']."&id_user=".$show_user_a['id_user']."&page=".$page."'><img title='Удалить' src='images/delete_mess.gif'></a>
                                            </td></tr>";
    echo "</table>";
   $month_row = mysql_fetch_array ($month);
   $time_row = mysql_fetch_array ($time);
   $year_row = mysql_fetch_array ($year);
   $day_row = mysql_fetch_array ($day);
  
}
while ($show_mess_a = mysql_fetch_array($show_mess));
$selected_sub_theme = mysql_query ("SELECT * from sub_theme where id_sub_theme='$topic'");
$selected_sub_theme_a = mysql_fetch_array($selected_sub_theme);


if ($_SESSION['moderator'] == 1 && $selected_sub_theme_a['locked'] == 0) echo "<a href='close_sub_theme.php?t=".$topic."'><img src='images/topic_lock.gif' title='Закрыть тему'></a><br>";
else if ($_SESSION['moderator'] == 1 && $selected_sub_theme_a['locked'] == 1) echo "<a href='open_sub_theme.php?t=".$topic."'><img src='images/topic_unlock.gif' title='Открыть тему'></a>";
//echo ("<script>document.forms['f1'].elements[0].focus();</script>");
//echo "<a href='viewtopic.php?g=".$_GET['g']."&s=".$_GET['s']."&t=".$topic."&page=0&k=".$k_."#top'>Наверх</a>";

if ($k != 0)
{
    echo "<table><tr>";
for($i = 0; $i < $k; $i ++)
{
	echo "<td class=page><span><a href='viewtopic.php?g=".$global."&s=".$_GET['s']."&t=".$topic."&page=".$i."&k=".$_GET['k']."'>".($i+1)."</a></span></td>";
}
echo "</tr></table>";
}
if ($selected_sub_theme_a['locked'] == 0) include "add_message.php";

else echo "<img align=right src='images/theme_closed.gif'><br><br>";
include "footer.php";
if ($_GET['r'] == 1)
{
    echo "<script>document.forms['f1'].elements[0].focus();scrollBy(0,-300);</script>" ;
    unset($_GET['r']);
}

?>
