<script language="javascript" src="java.js"></script>
<?php
//error_reporting(0);
include "config/config.php";
include "header.php";
include "menu.php";
$datetime = date("Y-m-d H:i:s");
//$global_theme_id = $_GET['t'];

$theme_id = $_GET['s'];
$message = $_POST['text'];
$g = $_GET['t'];

$file = $HTTP_POST_VARS['file_'];
$file_name = $_FILES['file_']['name'];
$file_size = $_FILES['file_']['size'];
$file_type = $_FILES['file_']['type'];
$file_tmp = $_FILES['file_']['tmp_name'];

$select_user = mysql_query("SELECT * from users where login like '%".$_SESSION['username']."%'");
$select_user_a = mysql_fetch_array($select_user);

$user_theme = mysql_query("SELECT * from users");
$user_theme_a = mysql_fetch_array($user_theme);

$count_sub_theme = mysql_query("SELECT * from sub_theme");
if (mysql_num_rows($count_sub_theme) == 0)
{
$sub_theme_id = mysql_query("SELECT id_sub_theme from sub_theme order by id_sub_theme desc limit 1");
$sub_theme_id_a = mysql_fetch_array($sub_theme_id);
}
else
{
$sub_theme_id = mysql_query("SELECT id_sub_theme+1 from sub_theme order by id_sub_theme desc limit 1");
$sub_theme_id_a = mysql_fetch_array($sub_theme_id);
}
//echo "INSERT into message(id_sub_theme,id_user,text,data) VALUES ('".$sub_theme_id_a['id_sub_theme']."+1','".$select_user_a['id_user']."','$message','$datetime')";
//echo "INSERT into sub_theme(id_theme,id_user,name,data) values('$theme_id','".$select_user_a['id_user']."','$name','$datetime')";
$c = 0;

$name = $_POST['name'];
$vote_name = $_POST['vote_name'];

$answer1 = $_POST['answer1'];
$answer2 = $_POST['answer2'];
$answer3 = $_POST['answer3'];
$answer4 = $_POST['answer4'];
$answer5 = $_POST['answer5'];
$answer6 = $_POST['answer6'];
$answer7 = $_POST['answer7'];
$answer8 = $_POST['answer8'];
$answer9 = $_POST['answer9'];
$answer10 = $_POST['answer10'];

$find_sub_theme = mysql_query("SELECT * from sub_theme where name like '%".$name."%'");
$find_sub_theme_a = mysql_fetch_array($find_sub_theme);

if (isset($name) && $name == "") echo "<p class='error'>Введите название подтемы</p>";
else
if (isset($message) && $message == "") echo "<p class='error'>Введите текст сообщения</p>";
else
if (isset($name) && mysql_num_rows($find_sub_theme) !=0 ) echo "<p class='error'>Такая подтема уже существует!</p>";
else
if (isset($vote_name) && $vote_name != "" && (!isset($answer1) || !isset($answer2))) echo "<p class='error'>Введите хотя бы два варианта ответа</p>";
else
if (isset($name) && $name != "" && mysql_num_rows($find_sub_theme) == 0)
{
    $add = mysql_query("INSERT into sub_theme(id_theme,id_user,name,data,watchings,locked,attached) values('$theme_id','".$select_user_a['id_user']."','$name','$datetime',0,0,0)");

    if (mysql_num_rows($count_sub_theme) == 0)
{
    $add_theme_mess = mysql_query("INSERT into message(id_sub_theme,id_user,text,file,data) VALUES('1','".$select_user_a['id_user']."','".$message."','".$file_name."''".$datetime."')");
}
else
{
        $new_sub_theme = mysql_query("SELECT * FROM sub_theme where name like '".$name."'");
    $new_sub_theme_a = mysql_fetch_array($new_sub_theme);
    $add_theme_mess = mysql_query("INSERT into message(id_sub_theme,id_user,text,file,data) VALUES('".$new_sub_theme_a['id_sub_theme']."','".$select_user_a['id_user']."','".$message."','".$file_name."','".$datetime."')");
    if ($file_name != "") move_uploaded_file($file_tmp, 'files/'.$file_name);
    //echo "INSERT into message(id_sub_theme,id_user,text,data) VALUES('".$new_sub_theme_a['id_sub_theme']."','".$select_user_a['id_user']."','".$message."','".$datetime."')";
}
    $add_theme = mysql_query("UPDATE users SET themes=themes+1 where login like '%".$_SESSION['username']."%'");
    $add_mess = mysql_query("UPDATE users SET texts=texts+1 where login like '%".$_SESSION['username']."%'");
    if (isset($vote_name) && $vote_name != "" && isset($answer1) && $answer1 != "" && isset($answer2) && $answer2 != "")
    {
     $add_vote = mysql_query("INSERT INTO vote_id_sub_theme(id_sub_theme,vote_name) VALUES('".$new_sub_theme_a['id_sub_theme']."','".$vote_name."')");
   }
    $selected_vote = mysql_query("SELECT * FROM vote_id_sub_theme where vote_name like '".$vote_name."'");
    $selected_vote_a = mysql_fetch_array($selected_vote);
    
    if (isset($answer1) && isset($answer2))
    {
        $add_answer1 = mysql_query("INSERT INTO vote_answer(id_vote_id_sub_theme,answer) VALUES('".$selected_vote_a['id_vote_id_sub_theme']."','".$answer1."')");
        $add_answer2 = mysql_query("INSERT INTO vote_answer(id_vote_id_sub_theme,answer) VALUES('".$selected_vote_a['id_vote_id_sub_theme']."','".$answer2."')");
    }
    if (isset($answer3) && $answer3 != "") $add_answer3 = mysql_query("INSERT INTO vote_answer(id_vote_id_sub_theme,answer) VALUES('".$selected_vote_a['id_vote_id_sub_theme']."','".$answer3."')");
    if (isset($answer4) && $answer4 != "") $add_answer4 = mysql_query("INSERT INTO vote_answer(id_vote_id_sub_theme,answer) VALUES('".$selected_vote_a['id_vote_id_sub_theme']."','".$answer4."')");
    if (isset($answer5) && $answer5 != "") $add_answer5 = mysql_query("INSERT INTO vote_answer(id_vote_id_sub_theme,answer) VALUES('".$selected_vote_a['id_vote_id_sub_theme']."','".$answer5."')");
    if (isset($answer6) && $answer6 != "") $add_answer6 = mysql_query("INSERT INTO vote_answer(id_vote_id_sub_theme,answer) VALUES('".$selected_vote_a['id_vote_id_sub_theme']."','".$answer6."')");
    if (isset($answer7) && $answer7 != "") $add_answer7 = mysql_query("INSERT INTO vote_answer(id_vote_id_sub_theme,answer) VALUES('".$selected_vote_a['id_vote_id_sub_theme']."','".$answer7."')");
    if (isset($answer8) && $answer8 != "") $add_answer8 = mysql_query("INSERT INTO vote_answer(id_vote_id_sub_theme,answer) VALUES('".$selected_vote_a['id_vote_id_sub_theme']."','".$answer8."')");
    if (isset($answer9) && $answer9 != "") $add_answer9 = mysql_query("INSERT INTO vote_answer(id_vote_id_sub_theme,answer) VALUES('".$selected_vote_a['id_vote_id_sub_theme']."','".$answer9."')");
    if (isset($answer10) && $answer10 != "") $add_answer10 = mysql_query("INSERT INTO vote_answer(id_vote_id_sub_theme,answer) VALUES('".$selected_vote_a['id_vote_id_sub_theme']."','".$answer10."')");
    
    $c = 1;
    $name = "";
    $vote_name = "";
}
//else if (mysql_num_rows($find_sub_theme) != 0) echo

if ($c == 0)
{
echo "<center><form name='add' enctype='multipart/form-data' action='add_sub_theme.php?s=".$theme_id."&t=".$_GET['t']."' method='POST'>
<br>Введите название подтемы  <br><br><input type='text' name='name'><br><br>
Введите текст сообщения <br><br>";
include "format_text.php";
include "smiles.php";
echo "<textarea cols=80 rows=15 name=text id=message></textarea><br><br>
<a id='vote' class=error>Добавить голосование</a>
<span id='show_vote' style='display:none'>

<br>Введите тему голосования<br><br><input type=text name=vote_name size=80><br>
<hr><br></center>
<table><tr><td class=answer>Введите вариант ответа - <input type=text name=answer1></td></tr></table>

<table><tr><td class=answer>Введите вариант ответа - <input type=text name=answer2>
<input type=button size=500 onclick='add_answer(3);' value='Добавить вариант'></td></tr></table>

<div id=add_answer_3 style=display:none>
<table><tr><td class=answer>Введите вариант ответа - <input type=text name=answer3>
<input type=button size=500 onclick='add_answer(4);' value='Добавить вариант'>
<input type=button size=500 onclick='delete_answer(3);' value='Удалить вариант'></td></tr></table>
</div>
<div id=add_answer_4 style=display:none>
<table><tr><td class=answer>Введите вариант ответа - <input type=text name=answer4>
<input type=button size=500 onclick='add_answer(5);' value='Добавить вариант'>
<input type=button size=500 onclick='delete_answer(4);' value='Удалить вариант'></td></tr></table>
</div>
<div id=add_answer_5 style=display:none>
<table><tr><td class=answer>Введите вариант ответа - <input type=text name=answer5>
<input type=button size=500 onclick='add_answer(6);' value='Добавить вариант'>
<input type=button size=500 onclick='delete_answer(5);' value='Удалить вариант'></td></tr></table>
</div>
<div id=add_answer_6 style=display:none>
<table><tr><td class=answer>Введите вариант ответа - <input type=text name=answer6>
<input type=button size=500 onclick='add_answer(7);' value='Добавить вариант'>
<input type=button size=500 onclick='delete_answer(6);' value='Удалить вариант'></td></tr></table>
</div>
<div id=add_answer_7 style=display:none>
<table><tr><td class=answer>Введите вариант ответа - <input type=text name=answer7>
<input type=button size=500 onclick='add_answer(8);' value='Добавить вариант'>
<input type=button size=500 onclick='delete_answer(7);' value='Удалить вариант'></td></tr></table>
</div>
<div id=add_answer_8 style=display:none>
<table><tr><td class=answer>Введите вариант ответа - <input type=text name=answer8>
<input type=button size=500 onclick='add_answer(9);' value='Добавить вариант'>
<input type=button size=500 onclick='delete_answer(8);' value='Удалить вариант'></td></tr></table>
</div>
<div id=add_answer_9 style=display:none>
<table><tr><td class=answer>Введите вариант ответа - <input type=text name=answer9>
<input type=button size=500 onclick='add_answer(10);' value='Добавить вариант'>
<input type=button size=500 onclick='delete_answer(9);' value='Удалить вариант'></td></tr></table>
</div>
<div id=add_answer_10 style=display:none>
<table><tr><td class=answer>Введите вариант ответа - <input type=text name=answer10><input type=button size=500 onclick='delete_answer(10);' value='Удалить вариант'></td></tr></table>
</div>
</span>
<center>
<a id='add_file' class=error>Прикрепить файл</a>
<br><span id='add_file_' style=display:none><br>
<span class='error'>Можно приклеплять файлы размером до 2мб</span>
<br><input type=file name='file_'><br>
</span></center>
<center>
<br><br><input type='submit' value='Создать'>
</form></center>";




echo " <script src='jquery-latest.js'></script>
  <script>

  $('#vote').click(function(){
    $('#show_vote').slideToggle(1000);
  });
  $('#add_file').click(function(){
    $('#add_file_').slideToggle(1000);
  });
  
  </script>";
}
//echo "INSERT into message(id_sub_theme,id_user,text,data) VALUES('0','".$select_user_a['id_user']."','".$message."','".$datetime."')";
if ($c == 1)
{
    echo "<p class=create>Подтема успешно создана</p>";
        if (mysql_num_rows($count_sub_theme) == 0)
{
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?t=1\"",1000);</script>';
}
else
{
    echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?g='.$g.'&s='.$_GET['s'].'&t='.$new_sub_theme_a['id_sub_theme'].'&page=0&k=0&add=1\"",1000);</script>';
    //g=".$_GET['t']."&s=".$_GET['s']."&t=".$show_sub_theme_a['id_sub_theme']."&page=0&k=".$k."&add=1
}
}

include "footer.php";
?>
