<script language="javascript" src="java.js"></script>
<?php
//error_reporting(0);
include "config/config.php";
include "header.php";
include "menu.php";
$vote = $_GET['id_vote'];

$selected_answer = $_POST['selected_answer'];

$selected_vote = mysql_query("SELECT * FROM vote_answer where id_vote_id_sub_theme=".$vote." and answer like '".$selected_answer."'");
$selected_vote_a = mysql_fetch_array($selected_vote);



$add_user_answer = mysql_query("INSERT INTO vote_answer_user(id_vote_answer,id_user) VALUES('".$selected_vote_a['id_vote_answer']."','".$_SESSION['id_user']."')");

//echo $selected_answer;
if ($add_user_answer)
{
     echo "<p class='create'>Голос успешно добавлен</p>";
     echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewtopic.php?g='.$_GET['g'].'&s='.$_GET['s'].'&t='.$_GET['t'].'&page='.$_GET['page'].'&k='.$_GET['k'].'\"",1000);</script>';
}
include "footer.php";
?>