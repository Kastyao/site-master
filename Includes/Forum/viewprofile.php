<?php
session_start();
error_reporting(0);
include "config/config.php";
include "header.php";
include "menu.php";

if ($_SESSION['enter'] == 1 && isset($_GET['user']))
{
$show_profile = mysql_query("SELECT * from users where id_user = ".$_GET['user']."");
$show_profile_a = mysql_fetch_array($show_profile);
echo "<table><tr><td class='noborder'><a href=''>".$show_profile_a['login']."</a><br><span class='icq'>".$show_profile_a['status']."</span><br><img height=99 width=99 src='images/".$show_profile_a['avatar']."'><br><br><span class='icq'>ICQ&nbsp;:&nbsp;".$show_profile_a['icq']."<br>Возвраст&nbsp;:&nbsp;".$show_profile_a['age']."<br>Пол&nbsp;:&nbsp;".$show_profile_a['sex']."<br>Обо мне&nbsp;:&nbsp;".$show_profile_a['podpis']."<br>Сообщений&nbsp;:&nbsp;".$show_profile_a['texts']."<br>Тем&nbsp;:&nbsp;".$show_profile_a['themes']."<br>Дата регистрации&nbsp;:&nbsp;".$show_profile_a['date']."</span><br><a href='send_private_message.php?id_user=".$show_profile_a['id_user']."&idd=1'><img src='images/icon_pm.gif'></a></td></table>";
}
else if ($_SESSION['enter'] == 0) echo "<p class='error'>Вы не зарегестрированы</p>";
        
    
  if ($_SESSION['enter'] == 1)
{  
    $id_user = $_GET['id_user'];
    $show_user = mysql_query("SELECT * from users where id_user=".$_SESSION['id_user']."");
    $show_user_a = mysql_fetch_array($show_user);
    
    if (!isset($_GET['action']) && !isset($_GET['user']))
    echo "<table align=left><tr><td class='noborder'><a href=''>".$show_user_a['login']."</a><br><span class='icq'>".$show_user_a['status']."</span><br><img height=99 width=99 src='images/".$show_user_a['avatar']."'><br><br><span class='icq'>ICQ&nbsp;:&nbsp;".$show_user_a['icq']."<br>Возвраст&nbsp;:&nbsp;".$show_user_a['age']."<br>Пол&nbsp;:&nbsp;".$show_user_a['sex']."<br>Обо мне&nbsp;:&nbsp;".$show_user_a['podpis']."<br>Сообщений&nbsp;:&nbsp;".$show_user_a['texts']."<br>Тем&nbsp;:&nbsp;".$show_user_a['themes']."<br>Дата регистрации&nbsp;:&nbsp;".$show_user_a['date']."</span></td></table>";
    
    if (isset($_GET['action']))
    {
        if ($_GET['action'] == "chpass")
        {
            $password = $_POST['password'];
            $password_check = $_POST['password_check'];
            
            
            if ($password == "" && isset($password)) echo "<p class=error>Вы не ввели пароль</p>";
            else if ($password != $password_check) echo "<p class=error>Пароли не совпадают</p>";
            else if(isset($password))
            {
                $c = 1;
                $update_ = mysql_query("UPDATE users set password='$password' where id_user=".$_SESSION['id_user']."");
                echo "<p class=create>Пароль успешно изменён</p>";
                echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewprofile.php\"",1000);</script>'; 
            }
            if ($c != 1)
            echo "<center><form method=POST action='viewprofile.php?id=".$_SESSION['id_user']."&action=chpass'>Введите новый пароль<br>
            <input type=password name=password><br>Повторите пароль<br><input type=password name=password_check><br><br>
            <input type=submit value='Изменить'></form></center>";
            
        }
        if ($_GET['action'] == "chavatar")
        {
            $selected_avatar = mysql_query("SELECT avatar FROM users where id_user = ".$_SESSION['id_user']."");
            $selected_avatar_a = mysql_fetch_array($selected_avatar);
            echo "<center>Текущее изображение<br><img  height=99 width=99 src='images/".$selected_avatar_a['avatar']."'></center><br><hr><br>";
            $avatar = $HTTP_POST_VARS['avatar'];
            $file_name = $_FILES['avatar']['name'];
            $file_size = $_FILES['avatar']['size'];
            $file_type = $_FILES['avatar']['type'];
            $file_tmp = $_FILES['avatar']['tmp_name'];
            if ($file_name == "" && isset($file_name)) echo "<p class=error>Выберите аватар !</p>";
            else if (isset($file_name)) {
                $c = 1;
                $update_ = mysql_query("UPDATE users set avatar='$file_name' where id_user=".$_SESSION['id_user']."");
                echo "<p class=create>Аватарка успешно отредактивована</p>";
                echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewprofile.php\"",1000);</script>'; 
                }
            if ($c != 1)
            echo "<center><form enctype='multipart/form-data' action='viewprofile.php?id=".$_SESSION['id_user']."&action=chavatar' method='POST'>
            Выберите новый аватар - <br><input type='file' name='avatar' size=65><br><br>
            <input type=submit value='Изменить'></form></center>";
            
        }
        if ($_GET['action'] == "chicq")
        {
            $icq = $_POST['icq'];
            if (isset($icq) && $icq == "") echo "<p class=error>Введите ICQ</p>";
           // else if (is($icq)) echo "<p class=error>ICQ состоит только из цифр</p>";
            else if (isset($icq))
            {
                $c = 1;
                $update_ = mysql_query("UPDATE users set icq='$icq' where id_user=".$_SESSION['id_user']."");
                echo "<p class=create>ICQ успешно изменено</p>";
                echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewprofile.php\"",1000);</script>'; 
            }
            if ($c != 1)
            echo "<center><form method=POST action='viewprofile.php?id=".$_SESSION['id_user']."&action=chicq'>Введите новое icq<br><input type=text name='icq'>
            <br><br><input type=submit value='Изменить'></form></center>";
        }
        if ($_GET['action'] == "chpodpis")
        {
            $podpis = $_POST['podpis'];
            if (isset($podpis) && $podpis == "") echo "<p class=error>Введите подпись</p>";
            else if (isset($podpis) && $podpis != "")
            {
                $c = 1;
                $update_ = mysql_query("UPDATE users set podpis='$podpis' where id_user=".$_SESSION['id_user']."");
                echo "<p class=create>Подпись успешно изменена</p>";
                echo '<script language="JavaScript">var f = setTimeout("window.location=\"viewprofile.php\"",1000);</script>'; 
            }
         if ($c != 1)
            echo "<center><form action=viewprofile.php?id=".$_SESSION['id_user']."&action=chpodpis method=POST>Введите подпись<br><input type=text name='podpis'>
            <br><br><input type=submit value='Изменить'></form></center>";
        }
    }
    $user_profile = mysql_query("SELECT * from users where id_user='".$_SESSION['id_user']."'");
    $user_profile_a = mysql_fetch_array($user_profile);
    if (!isset($_GET['action']) && !isset($_GET['user']))
    {
    echo "<center><a href='viewprofile.php?id=".$_SESSION['id_user']."&action=chpass'> Сменить пароль </a><br>";
    echo "<a href='viewprofile.php?id=".$_SESSION['id_user']."&action=chavatar'> Сменить аватар </a><br>";
    echo "<a href='viewprofile.php?id=".$_SESSION['id_user']."&action=chicq'> Сменить ICQ </a><br>";
    echo "<a href='viewprofile.php?id=".$_SESSION['id_user']."&action=chpodpis'> Сменить подпись </a><br></center>";
    $select_user_reputation = mysql_query("SELECT * FROM reputation where id_user_get_reputation = ".$_SESSION['id_user']."");
    $select_user_reputation_a = mysql_fetch_array($select_user_reputation);
    if (mysql_num_rows($select_user_reputation) != 0)
    {
    echo "<br><table><tr><td class='rep_table_head'>Репутация</td></tr></table>";
    echo "<table align=center><tr><td class='rep_table'>Баллы</td><td class='rep_table'>Комментарий</td><td class='rep_table'>Отправитель</td><td class='rep_table'>Сообщение</td></tr>";
    
    do
    {
        $select_mess = mysql_query("SELECT * FROM message,reputation where message.id_message = reputation.id_message and reputation.id_user_get_reputation = ".$_SESSION['id_user']." and reputation.id_message = ".$select_user_reputation_a['id_message']."");
        $select_mess_a = mysql_fetch_array($select_mess);
        $select_sender = mysql_query("SELECT login,id_user from users where id_user = ".$select_user_reputation_a['id_user_send_reputation']."");
        $select_sender_a = mysql_fetch_array($select_sender);
        $select_sub_theme_mess = mysql_query("SELECT * FROM sub_theme,message where sub_theme.id_sub_theme = message.id_sub_theme and message.id_message = ".$select_mess_a['id_message']."");
        $select_sub_theme_mess_a = mysql_fetch_array($select_sub_theme_mess);
        $half_mess = explode(" ",$select_mess_a['text']);
        
        echo "<tr><td class='point_rep'>".$select_user_reputation_a['rep']."</td><td class='point_rep'>".$select_user_reputation_a['comment']."</td><td class='point_rep'><a href='viewprofile.php?user=".$select_sender_a['id_user']."'>".$select_sender_a['login']."</a></td><td class='point_rep'>";
         
         $count_pages = mysql_query("SELECT count(text) as c from message where id_sub_theme =".$select_mess_a['id_sub_theme']."");
         $count_pages_a = mysql_fetch_array($count_pages);
         $count_ = $count_pages_a['c'];
         $k = ceil($count_ / 10) - 1;
         if ($count_pages_a['c'] == 0) $k = 0;
        
        $select_theme = mysql_query("SELECT * FROM theme,sub_theme where sub_theme.id_theme = theme.id_theme and sub_theme.id_sub_theme = ".$select_sub_theme_mess_a['id_sub_theme']."");
        $select_theme_a = mysql_fetch_array($select_theme);
        
        $select_global_theme = mysql_query("SELECT * from theme,global_theme where theme.id_global_theme=global_theme.id_global_theme and theme.id_theme = ".$select_theme_a['id_theme']."");
        $select_global_theme_a = mysql_fetch_array($select_global_theme);
        
        
        $half_mess = str_replace("[u]","",$half_mess);
        $half_mess = str_replace("[/u]","",$half_mess);
        $half_mess = str_replace("[b]","",$half_mess);
        $half_mess = str_replace("[/b]","",$half_mess);
        $half_mess = str_replace("[i]","",$half_mess);
        $half_mess = str_replace("[/i]","",$half_mess);
        $half_mess = str_replace("[url]","",$half_mess);
        $half_mess = str_replace("[/url]","",$half_mess);
        $half_mess = str_replace("[img]","",$half_mess);
        echo "<a href='viewtopic.php?t=".$select_sub_theme_mess_a['id_sub_theme']."&k=".$k."&g=".$select_global_theme_a['id_global_theme']."&s=".$select_theme_a['id_theme']."&page=0'>";
         for($i = 0; $i < 5; $i ++) echo "".$half_mess[$i]." ";
        if (count($half_mess) > 5) echo "...";
        
        echo "</a></td></tr>";
    }
    while ($select_user_reputation_a = mysql_fetch_array($select_user_reputation));
    
    echo "</table>";
    }
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";
    }
}

include "footer.php";


?>