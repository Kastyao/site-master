<?php
error_reporting(0);
include "config/config.php";
include "header.php";
include "menu.php";

$theme = $_GET['t'];
$sub_theme = $_GET['s'];

if (isset($sub_theme) && !isset($theme))
{
$show_path_global = mysql_query("SELECT name,id_global_theme from global_theme where id_global_theme='$theme'");
$show_path_global_a = mysql_fetch_array($show_path_global);
$show_path_theme = mysql_query("SELECT name from theme where theme.id_theme='$sub_theme'");
$show_path_theme_a = mysql_fetch_array($show_path_theme);
echo "<a href='index.php'>Форум</a>->";
    echo "<a href='viewforum.php?t=".$show_path_global_a['id_global_theme']."'>".$show_path_global_a['name']."</a>";
    echo "->";
    echo "<a href='viewforum.php?s=".$sub_theme."'>".$show_path_theme_a['name']."</a>";
}
else
if (isset($theme) && !isset($sub_theme))
{
$show_path_global = mysql_query("SELECT name,id_global_theme from global_theme where id_global_theme='$theme'");
$show_path_global_a = mysql_fetch_array($show_path_global);
$show_path_theme = mysql_query("SELECT name from theme where theme.id_theme='$theme'");
$show_path_theme_a = mysql_fetch_array($show_path_theme);
echo "<a href='index.php'>Форум</a>->";
    echo "<a href='viewforum.php?t=".$show_path_global_a['id_global_theme']."'>".$show_path_global_a['name']."</a>";

}
include "table_head.php";

if (isset($theme) && !isset($sub_theme))
{
$show_theme = mysql_query("SELECT theme.id_theme,theme.name from theme where theme.id_global_theme='$theme'");
$show_theme_a = mysql_fetch_array($show_theme);
$col = mysql_num_rows($show_theme);
if ($col == 0) echo "<table><p class='nothemes'>Тем нету</p></table>";
else
do 
{
    $show_sub_theme = mysql_query("SELECT * from sub_theme where sub_theme.id_theme='$sub_theme'");
    $show_sub_theme_a = mysql_fetch_array($show_sub_theme);
    
    
    
    $count_pages = mysql_query("SELECT count(text) as c from message where id_sub_theme =".$show_sub_theme_a['id_sub_theme']."");
    $count_pages_a = mysql_fetch_array($count_pages);
    $count_ = $count_pages_a['c'];
    $k = ceil($count_ / 10) - 1;
    if ($count_pages_a['c'] == 0) $k = 0;
    
    echo "<tr><td class='themes_'><a href='viewforum.php?s=".$show_theme_a['id_theme']."&t=".$theme."'>".$show_theme_a['name']."</a></td>";
    
    $count_themes = mysql_query("SELECT count(id_sub_theme) from sub_theme,theme where theme.id_theme=sub_theme.id_theme and theme.id_theme=".$show_theme_a['id_theme']."");
    $count_themes_a = mysql_fetch_array($count_themes);
    
    $count_mess = mysql_query("SELECT count(id_message) from message,sub_theme,theme where message.id_sub_theme=sub_theme.id_sub_theme and sub_theme.id_theme = theme.id_theme and theme.id_theme=".$show_theme_a['id_theme']."");
    $count_mess_a = mysql_fetch_array($count_mess);
    
    
    $last_mess = mysql_query("SELECT sub_theme.name,message.data,users.login,sub_theme.id_sub_theme,users.id_user from message,sub_theme,theme,users where
                              message.id_sub_theme=sub_theme.id_sub_theme and message.id_user=users.id_user 
                              and sub_theme.id_theme=theme.id_theme
                              and theme.id_theme=".$show_theme_a['id_theme']." order by message.data limit 1");
    $last_mess_a = mysql_fetch_array($last_mess);  
     $selected_theme = mysql_query("SELECT * FROM theme,sub_theme where sub_theme.id_sub_theme = ".$last_mess_a['id_sub_theme']." and sub_theme.id_theme = theme.id_theme");
    $selected_theme_a = mysql_fetch_array($selected_theme);
    echo "<td class='td_themes'>".$count_themes_a['count(id_sub_theme)']."</td>";
    echo "<td class='td_themes'>".$count_mess_a['count(id_message)']."</td>";
   // echo "<td class='last_mess'><a href='viewtopic.php?t=".$last_mess_a['id_sub_theme']."'><img src='images/thm.gif'>".$last_mess_a['name']."</a><br/><span class='icq'>".$last_mess_a['data']."</span><br><a href='viewprofile.php?user=".$last_mess_a['id_user']."'>".$last_mess_a['login']."</a></td>";
    
    echo "<td class='last_mess'><a href='viewtopic.php?g=".$_GET['t']."&s=".$selected_theme_a['id_theme']."&t=".$last_mess_a['id_sub_theme']."&page=0&k=".$k."&add=1' title='".$last_mess_a['name']."'>";
    
  // g=".$global_a['id_global_theme']."&s=".$selected_theme_a['id_theme']."&t=".$last_mess_a['id_sub_theme']."&page=0&k=".$k."&add=1
    if (mysql_num_rows($last_mess) != 0)
    {
        $select_vote = mysql_query("SELECT * from vote_id_sub_theme where id_sub_theme = ".$last_mess_a['id_sub_theme']."");
         $half_mess = explode(" ",$last_mess_a['name']);
        echo "<img src='images/thm.gif'> ";
        if (mysql_num_rows($select_vote) > 0  ) echo "Опрос: ";
            for($i = 0; $i < 5; $i ++) echo "".$half_mess[$i]." ";
            if (count($half_mess) > 5) echo "...";
        echo "</a><br/>".$last_mess_a['data']."<br><a href='viewprofile.php?user=".$last_mess_a['id_user']."'>".$last_mess_a['login']."</a></td>";
   }
    //if (mysql_num_rows($last_mess) != 0) echo "<img src='images/thm.gif'>".$last_mess_a['name']."</a><br/><span class='icq'>".$last_mess_a['data']."</span><br><a href='viewprofile.php?user=".$last_mess_a['id_user']."'>".$last_mess_a['login']."</a></td>";
    if ($_SESSION['moderator'] == 1) echo "<td class=last_mess><a href=delete_theme.php?s=".$show_theme_a['id_theme']."&t=".$_GET['t']."><img title='Удалить' src='images/delete_mess.gif'></a><br>
    <a href=change_theme.php?s=".$show_theme_a['id_theme']."&t=".$_GET['t']."><img src='images/icon_edit.gif' title='Править'></a></td>";
}
while ($show_theme_a = mysql_fetch_array($show_theme));
}
else
 if (isset($sub_theme) && !isset($theme))
 {
    
$show_sub_theme = mysql_query("SELECT * from sub_theme where sub_theme.id_theme='$sub_theme'");
$show_sub_theme_a = mysql_fetch_array($show_sub_theme);
$col = mysql_num_rows($show_sub_theme);

if ($col == 0) echo "<table><p class='nothemes'>Тем нету</p></table>";
do 
{
    $count_pages = mysql_query("SELECT count(text) as c from message where id_sub_theme =".$show_sub_theme_a['id_sub_theme']."");
    $count_pages_a = mysql_fetch_array($count_pages);
    $count_ = $count_pages_a['c'];
    $k = ceil($count_ / 10) - 1;
    if ($count_pages_a['c'] == 0) $k = 0;
    
    echo "<tr><td class='themes_'><a href='viewtopic.php?t=".$show_sub_theme_a['id_sub_theme']."&page=0&k=".$k."&add=1'>".$show_sub_theme_a['name']."</a></td>";
    
   /* $count_themes = mysql_query("SELECT count(id_sub_theme) from sub_theme,theme where theme.id_theme=sub_theme.id_theme and theme.id_theme=".$show_theme_a['id_theme']."");
    $count_themes_a = mysql_fetch_array($count_themes); */
    
    $count_mess = mysql_query("SELECT count(id_message) from message,sub_theme where message.id_sub_theme=sub_theme.id_sub_theme and sub_theme.id_sub_theme=".$show_sub_theme_a['id_sub_theme']."");
    $count_mess_a = mysql_fetch_array($count_mess);
    
    
    $last_mess = mysql_query("SELECT message.data,users.login,sub_theme.id_sub_theme,users.id_user from message,sub_theme,users where
                              message.id_sub_theme=sub_theme.id_sub_theme and message.id_user=users.id_user 
                              and sub_theme.id_sub_theme=".$show_sub_theme_a['id_sub_theme']."  order by message.data limit 1");
    $last_mess_a = mysql_fetch_array($last_mess);  
    
    //echo "<td class='td_themes'>".$count_themes_a['count(id_sub_theme)']."</td>";
    
    echo "<td class='td_themes'>".$count_mess_a['count(id_message)']."</td>";
    echo "<td class='last_mess'>".$last_mess_a['data']."<br><a href='viewprofile.php?user=".$last_mess_a['id_user']."'>".$last_mess_a['login']."</a></td>";
    if ($_SESSION['moderator'] == 1 && $col != 0) echo "<td class=last_mess><a href=delete_sub_theme.php?t=".$show_sub_theme_a['id_sub_theme']."&s=".$_GET['s']."><img title='Удалить' src='images/delete_mess.gif'></a><br>
    <a href=change_sub_theme.php?t=".$show_sub_theme_a['id_sub_theme']."&s=".$_GET['s']."><img src='images/icon_edit.gif' title='Править'></a></td>";
}
while ($show_sub_theme_a = mysql_fetch_array($show_sub_theme));   
}
else
 if (isset($sub_theme) && isset($theme))
 {

$show_path_global = mysql_query("SELECT name,id_global_theme from global_theme where id_global_theme='$theme'");
$show_path_global_a = mysql_fetch_array($show_path_global);
$show_path_theme = mysql_query("SELECT name from theme where theme.id_theme='$sub_theme'");
$show_path_theme_a = mysql_fetch_array($show_path_theme);
echo "<a href='index.php'>Форум</a>->";
    echo "<a href='viewforum.php?t=".$show_path_global_a['id_global_theme']."'>".$show_path_global_a['name']."</a>";
    echo "->";
    echo "<a href='viewforum.php?s=".$sub_theme."&t=".$theme."'>".$show_path_theme_a['name']."</a>";
$show_sub_theme = mysql_query("SELECT * from sub_theme where sub_theme.id_theme='$sub_theme' order by data desc");
$show_sub_theme_a = mysql_fetch_array($show_sub_theme);
$col = mysql_num_rows($show_sub_theme);

if ($col == 0) echo "<table><p class='nothemes'>Тем нету</p></table>";
else
do 
{
    $count_pages = mysql_query("SELECT count(text) as c from message where id_sub_theme =".$show_sub_theme_a['id_sub_theme']."");
    $count_pages_a = mysql_fetch_array($count_pages);
    $count_ = $count_pages_a['c'];
    $k = ceil($count_ / 10) - 1;
    if ($count_pages_a['c'] == 0) $k = 0;
    $select_login = mysql_query ("SELECT login from users where id_user = ".$show_sub_theme_a['id_user']."");
    $select_login_a = mysql_fetch_array($select_login);
    echo "<tr><td class='themes_small'><a href='viewtopic.php?g=".$_GET['t']."&s=".$_GET['s']."&t=".$show_sub_theme_a['id_sub_theme']."&page=0&k=".$k."&add=1'>";
    $select_vote = mysql_query("SELECT * from vote_id_sub_theme where id_sub_theme = ".$show_sub_theme_a['id_sub_theme']."");
    if (mysql_num_rows($select_vote) > 0 )
    echo "<span style=color:gray>Опрос: </span>".$show_sub_theme_a['name']."</a><br><span class='icq'>Автор - <a href='viewprofile.php?user=".$show_sub_theme_a['id_user']."'>".$select_login_a['login']."</a></span></td>";
    else echo "".$show_sub_theme_a['name']."</a><br><span class='icq'>Автор - <a href='viewprofile.php?user=".$show_sub_theme_a['id_user']."'>".$select_login_a['login']."</a></span></td>";
   /* $count_themes = mysql_query("SELECT count(id_sub_theme) from sub_theme,theme where theme.id_theme=sub_theme.id_theme and theme.id_theme=".$show_theme_a['id_theme']."");
    $count_themes_a = mysql_fetch_array($count_themes); */
    
    $count_mess = mysql_query("SELECT count(id_message) from message,sub_theme where message.id_sub_theme=sub_theme.id_sub_theme and sub_theme.id_sub_theme=".$show_sub_theme_a['id_sub_theme']."");
    $count_mess_a = mysql_fetch_array($count_mess);
    
    
    $last_mess = mysql_query("SELECT message.data,users.login,sub_theme.id_sub_theme,users.id_user from message,sub_theme,users where
                              message.id_sub_theme=sub_theme.id_sub_theme and message.id_user=users.id_user 
                              and sub_theme.id_sub_theme=".$show_sub_theme_a['id_sub_theme']."  order by message.data limit 1");
    $last_mess_a = mysql_fetch_array($last_mess);
    
    //echo "<td class='td_themes'>".$count_themes_a['count(id_sub_theme)']."</td>";
    echo "<td class=td_themes>".$show_sub_theme_a['watchings']."</td>";
    echo "<td class='td_themes'>".$count_mess_a['count(id_message)']."</td>";
    echo "<td class='last_mess'>".$last_mess_a['data']."<br><a href='viewprofile.php?user=".$last_mess_a['id_user']."'>".$last_mess_a['login']."</a></td>";
    if ($_SESSION['moderator'] == 1) echo "<td class=last_mess><a href=delete_sub_theme.php?t=".$show_sub_theme_a['id_sub_theme']."&s=".$_GET['s']."&g=".$_GET['t']."><img title='Удалить' src='images/delete_mess.gif'></a><br>
    <a href=change_sub_theme.php?t=".$show_sub_theme_a['id_sub_theme']."&s=".$_GET['s']."&g=".$_GET['t']."><img src='images/icon_edit.gif' title='Править'></a></td>";
}
while ($show_sub_theme_a = mysql_fetch_array($show_sub_theme));   
}

include "table_foot.php";
if (isset($sub_theme) && !isset($theme))
{
echo "<br><br><a href='index.php'>Форум</a>->";
    echo "<a href='viewforum.php?t=".$show_path_global_a['id_global_theme']."'>".$show_path_global_a['name']."</a>";
    echo "->";
    echo "aasd<a href='viewforum.php?s=".$sub_theme."'>".$show_path_theme_a['name']."</a>";
}
else
if (isset($theme) && !isset($sub_theme))
{
echo "<a href='index.php'>Форум</a>->";
    echo "<a href='viewforum.php?t=".$show_path_global_a['id_global_theme']."'>".$show_path_global_a['name']."</a>";

}
else
 if (isset($sub_theme) && isset($theme))
 {
echo "<br><a href='index.php'>Форум</a>->";
    echo "<a href='viewforum.php?t=".$show_path_global_a['id_global_theme']."'>".$show_path_global_a['name']."</a>";
    echo "->";
    echo "<a href='viewforum.php?s=".$sub_theme."&t=".$theme."'>".$show_path_theme_a['name']."</a>";
}
if ($_SESSION['enter'] == 1 && isset($sub_theme) && isset($theme))
echo "<span class=new_theme><a href='add_sub_theme.php?t=".$theme."&s=".$sub_theme."'><img src=images/new_sub_theme.gif></a></span><br><br>";
if ($_SESSION['enter'] == 1 && isset($theme) && $_SESSION['moderator']== 1 && !isset($sub_theme))
echo "<span class=new_theme><a href='add_theme.php?t=".$theme."'><img src=images/new_sub_theme.gif></a></span><br><br>";
include "footer.php";
?>
