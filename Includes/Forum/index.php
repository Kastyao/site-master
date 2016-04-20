<?php
error_reporting(0);
include "config/config.php";
include "header.php";
include "menu.php";
include "table_head.php";
$global = mysql_query("SELECT * from global_theme where hidden=0");
$global_a = mysql_fetch_array($global);


do
{
    echo "<tr><td class='themes_'><a href='viewforum.php?t=".$global_a['id_global_theme']."'>".$global_a['name']." </a>";

    $theme_ = mysql_query("SELECT * from theme where id_global_theme = ".$global_a['id_global_theme']."");
    $theme_a = mysql_fetch_array($theme_);
    
    if (mysql_num_rows($theme_) > 0)    
    {
    echo "<br><span class='icq'>Подфорумы - ";
    do
    {
        echo "<a href='viewforum.php?t=".$global_a['id_global_theme']."&s=".$theme_a['id_theme']."'>".$theme_a['name'].",";
    }
    while($theme_a = mysql_fetch_array($theme_));
    
    echo "</td></span>";
    }
    
    $count_themes = mysql_query("SELECT count(id_theme) from theme where id_global_theme=".$global_a['id_global_theme']."");
    $count_themes_a = mysql_fetch_array($count_themes);

    $count_mess = mysql_query("SELECT count(id_message) from message,sub_theme,theme,global_theme where message.id_sub_theme=sub_theme.id_sub_theme
                               and sub_theme.id_theme=theme.id_theme and theme.id_global_theme=global_theme.id_global_theme
                               and global_theme.id_global_theme=".$global_a['id_global_theme']."");
    $count_mess_a = mysql_fetch_array($count_mess);
    
    $last_mess = mysql_query("SELECT sub_theme.name,message.data,users.login,sub_theme.id_sub_theme,users.id_user from message,sub_theme,theme,global_theme,users where
                              message.id_sub_theme=sub_theme.id_sub_theme and message.id_user=users.id_user 
                              and sub_theme.id_theme=theme.id_theme and theme.id_global_theme=global_theme.id_global_theme
                              and global_theme.id_global_theme=".$global_a['id_global_theme']." order by message.data desc limit 1");
    $last_mess_a = mysql_fetch_array($last_mess);  
    $selected_theme = mysql_query("SELECT * FROM theme,sub_theme where sub_theme.id_sub_theme = ".$last_mess_a['id_sub_theme']." and sub_theme.id_theme = theme.id_theme");
    $selected_theme_a = mysql_fetch_array($selected_theme);
    //echo "SELECT * FROM theme,sub_theme,message where sub_theme.id_sub_theme = ".$last_mess_a['id_sub_theme']." && sub_theme.id_theme = theme.id_theme";
   
   
    $count_pages = mysql_query("SELECT count(text) as c from message where id_sub_theme =".$last_mess_a['id_sub_theme']."");
    $count_pages_a = mysql_fetch_array($count_pages);
    $count_ = $count_pages_a['c'];
    $k = ceil($count_ / 10) - 1;
    if ($count_pages_a['c'] == 0) $k = 0;
    
    
    echo "<td class='td_themes'>".$count_themes_a['count(id_theme)']."</td>";
    echo "<td class='td_themes'>".$count_mess_a['count(id_message)']."</td>";
    echo "<td class='last_mess'><a href='viewtopic.php?g=".$global_a['id_global_theme']."&s=".$selected_theme_a['id_theme']."&t=".$last_mess_a['id_sub_theme']."&page=0&k=".$k."&add=1' title='".$last_mess_a['name']."'>";
    if (mysql_num_rows($last_mess) != 0)
    {

        $half_mess = explode(" ",$last_mess_a['name']);
        $select_vote = mysql_query("SELECT * from vote_id_sub_theme where id_sub_theme = ".$last_mess_a['id_sub_theme']."");
        
        echo "<img src='images/thm.gif'> ";
        if (mysql_num_rows($select_vote) > 0  ) echo "Опрос: ";
        for($i = 0; $i < 5; $i ++) echo "".$half_mess[$i]." ";
        if (count($half_mess) > 5) echo "...";
        echo "</a><br>".$last_mess_a['data']."<br><a href='viewprofile.php?user=".$last_mess_a['id_user']."'>".$last_mess_a['login']."</a></td>";
   }
    if ($_SESSION['moderator'] == 1 && $_SESSION['username'] == "admin")
    {
    echo "<td class=last_mess><a href=delete_global_theme.php?t=".$global_a['id_global_theme']."><img title='Удалить' src='images/delete_mess.gif'></a><br>
    <a href=change_global_theme.php?t=".$global_a['id_global_theme']."><img src='images/icon_edit.gif' title='Править'></a></td>";
    }
    //echo "<br>";
}
while ($global_a = mysql_fetch_array($global));

if ($_SESSION['moderator'] == 1) include "moderator_forum.php";
if ($_SESSION['moderator'] == 1)
{
    $show_hidden_global_themes = mysql_query("SELECT * FROM global_theme where hidden=1");
    $show_hidden_global_themes_a = mysql_fetch_array($show_hidden_global_themes);
    do
    {
         $theme_ = mysql_query("SELECT * from theme where id_global_theme = ".$show_hidden_global_themes_a['id_global_theme']."");
         $theme_a = mysql_fetch_array($theme_);
    echo "<tr><td class='themes_'><a href='viewforum.php?t=".$show_hidden_global_themes_a['id_global_theme']."'>".$show_hidden_global_themes_a['name']." </a>";
    
     if (mysql_num_rows($theme_) > 0)    
    {
        echo "<br><span class='icq'>Подфорумы - ";
    do
    {
        echo "<a href='viewforum.php?t=".$show_hidden_global_themes_a['id_global_theme']."&s=".$theme_a['id_theme']."'>".$theme_a['name'].",";
    }
    while($theme_a = mysql_fetch_array($theme_));
    }
    
   
    //while($theme_a = mysql_fetch_array($theme_)) {echo "<a href='viewforum.php?t=".$show_hidden_global_themes_a['id_global_theme']."&s=".$theme_a['id_theme']."'>".$theme_a['name'].",";}
    echo "</td></span>";
    
    
    $count_themes = mysql_query("SELECT count(id_theme) from theme where id_global_theme=".$show_hidden_global_themes_a['id_global_theme']."");
    $count_themes_a = mysql_fetch_array($count_themes);

    $count_mess = mysql_query("SELECT count(id_message) from message,sub_theme,theme,global_theme where message.id_sub_theme=sub_theme.id_sub_theme
                               and sub_theme.id_theme=theme.id_theme and theme.id_global_theme=global_theme.id_global_theme
                               and global_theme.id_global_theme=".$show_hidden_global_themes_a['id_global_theme']."");
    $count_mess_a = mysql_fetch_array($count_mess);
    
    $last_mess = mysql_query("SELECT sub_theme.name,message.data,users.login,sub_theme.id_sub_theme,users.id_user from message,sub_theme,theme,global_theme,users where
                              message.id_sub_theme=sub_theme.id_sub_theme and message.id_user=users.id_user 
                              and sub_theme.id_theme=theme.id_theme and theme.id_global_theme=global_theme.id_global_theme
                              and global_theme.id_global_theme=".$show_hidden_global_themes_a['id_global_theme']." order by message.data desc limit 1");
    $last_mess_a = mysql_fetch_array($last_mess);  
    
    $selected_theme = mysql_query("SELECT * FROM theme,sub_theme where sub_theme.id_sub_theme = ".$last_mess_a['id_sub_theme']." and sub_theme.id_theme = theme.id_theme");
    $selected_theme_a = mysql_fetch_array($selected_theme);    
             
    echo "<td class='td_themes'>".$count_themes_a['count(id_theme)']."</td>";
    echo "<td class='td_themes'>".$count_mess_a['count(id_message)']."</td>";
    echo "<td class='last_mess'><a href='viewtopic.php?g=".$show_hidden_global_themes_a['id_global_theme']."&s=".$selected_theme_a['id_theme']."&t=".$last_mess_a['id_sub_theme']."&page=0&k=".$k."&add=1' title='".$last_mess_a['name']."''>";
    if (mysql_num_rows($last_mess) != 0) echo "<img src='images/thm.gif'>".$last_mess_a['name']."</a><br/>".$last_mess_a['data']."<br><a href='viewprofile.php?user=".$last_mess_a['id_user']."'>".$last_mess_a['login']."</a></td>";
   if ($_SESSION['moderator'] == 1 && $_SESSION['username'] == "admin")
    echo "<td class=last_mess align=right><a href=delete_global_theme.php?t=".$show_hidden_global_themes_a['id_global_theme']."><img title='Удалить' src='images/delete_mess.gif'></a><br>
    <a href=change_global_theme.php?t=".$show_hidden_global_themes_a['id_global_theme']."><img src='images/icon_edit.gif' title='Править'></a></td>";
    }
    while ($show_hidden_global_themes_a = mysql_fetch_array($show_hidden_global_themes));
    
}

include "table_foot.php";
$count_sub_themes = mysql_query("SELECT count(id_sub_theme) FROM sub_theme");
$count_sub_themes_a = mysql_fetch_array($count_sub_themes);
$count_messages = mysql_query("SELECT count(id_message) FROM message");
$count_messages_a = mysql_fetch_array($count_messages);
$count_users = mysql_query("SELECT count(id_user) from users");
$count_users_a = mysql_fetch_array($count_users);
$select_last_reg_user = mysql_query("SELECT login,id_user from users order by date desc limit 1");
$select_last_reg_user_a = mysql_fetch_array($select_last_reg_user);
$select_online_users = mysql_query("SELECT login,id_user from users where online=1");
$select_online_users_a = mysql_fetch_array($select_online_users);
$hour = date("H");
$select_active_users = mysql_query("SELECT login,id_user from users where last_enter > subdate(now(),interval 24 hour)");
$select_active_users_a = mysql_fetch_array($select_active_users);

echo "<br><table><tr><td class='statistics' colspan=2>Статистика</td></tr>";
echo "<tr><td colspan=1 class='stat_noborder' width=5%><img src='images/stats.gif'></td>";
echo "<td class='stat_noborder' colspan=1>Тем - ".$count_sub_themes_a['count(id_sub_theme)'].";  Сообщений - ".$count_messages_a['count(id_message)'].";  Пользователей - ".$count_users_a['count(id_user)']."";
echo "<br>Приветствуем нового пользователя - <a href='viewprofile.php?user=".$select_last_reg_user_a['id_user']."'>".$select_last_reg_user_a['login']."</a></td></tr>";
echo "<tr><td colspan=1 class='stat_noborder' width=5%><img src='images/online.gif'></td><td class='stat_noborder' colspan=1>Сейчас на форуме - ";
do
{
    echo "<a href='viewprofile.php?user=".$select_online_users_a['id_user']."'>".$select_online_users_a['login']."</a>,";
}
while($select_online_users_a = mysql_fetch_array($select_online_users));

echo "<br>Активные пользователи за последние 24 часа - ";
do
{
    echo "<a href='viewprofile.php?user=".$select_active_users_a['id_user']."'>".$select_active_users_a['login']."</a>,";
}
while ($select_active_users_a = mysql_fetch_array($select_active_users));

echo "</td></tr></table>";


if ($_SESSION['enter'] == 1 && $_SESSION['username'] == "admin") echo "<span class=new_theme><a href='add_global_theme.php?'><img src=images/new_sub_theme.gif></a></span><br><br>";
include "footer.php";

?>
