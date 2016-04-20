<?php
error_reporting(0);
include "config/config.php";
include "header.php";
include "menu.php";
$find = $_POST['find'];
$radio_box = $_POST['radio_box'];


if (!isset($find) && $find == "" && $radio_box == "")
{
echo "<form method='POST' action='search.php?'>
<table>
<tr><td class='find_zap'>Введите запрос<br></td></tr>
<tr><td class='find_text'><input type=text name=find></td></tr>
<tr><td class='find_zap'>Параметры поиска</td></tr>
<tr><td class='find_text'>Поиск в темах<input type=radio name=radio_box value='themes'></td></tr>
<tr><td class='find_text'>Поиск в сообщениях<input type=radio name=radio_box value='mess'></td></tr>
<tr><td class='find_text'>Поиск везде<input checked=1 type=radio name=radio_box value='all'></td></tr>
<tr><td class='find_zap'></td></tr>
<tr><td class='find_text'><input type='submit' value='Поиск'></td></tr>
</form></table>";
}
if ($radio_box == "all") 
{
    
    $search = mysql_query("SELECT DISTINCT (name),sub_theme.id_sub_theme,watchings from sub_theme,message where ((sub_theme.name like '%".$find."%') or (message.text like '%".$find."%')) and sub_theme.id_sub_theme = message.id_sub_theme");
    $search_a = mysql_fetch_array($search);
    if (mysql_num_rows($search) == 0) echo "<p class='nothemes'>Запрос не дал результатов</p>";
    else
    {
    echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Кол-во просмотров</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>";
do
{
     $count_pages = mysql_query("SELECT count(text) as c from message where id_sub_theme =".$search_a['id_sub_theme']."");
    $count_pages_a = mysql_fetch_array($count_pages);
    $count_ = $count_pages_a['c'];
    $k = ceil($count_ / 10) - 1;
    if ($count_pages_a['c'] == 0) $k = 0;
    
    $count_mess = mysql_query("SELECT count(id_message) from message,sub_theme where message.id_sub_theme=sub_theme.id_sub_theme and sub_theme.id_sub_theme=".$search_a['id_sub_theme']."");
    $count_mess_a = mysql_fetch_array($count_mess);
    
    
    $last_mess = mysql_query("SELECT message.data,users.login,sub_theme.id_sub_theme,users.id_user from message,sub_theme,users where
                              message.id_sub_theme=sub_theme.id_sub_theme and message.id_user=users.id_user 
                              and sub_theme.id_sub_theme=".$search_a['id_sub_theme']."  order by message.data limit 1");
    $last_mess_a = mysql_fetch_array($last_mess);
    
    $theme_path = mysql_query("SELECT * FROM theme,sub_theme where sub_theme.id_sub_theme = ".$search_a['id_sub_theme']." and sub_theme.id_theme = theme.id_theme ");
    $theme_path_a = mysql_fetch_array($theme_path);
    $global_theme_path = mysql_query("SELECT * FROM theme,global_theme where theme.id_theme = ".$theme_path_a['id_theme']." and global_theme.id_global_theme = theme.id_global_theme");
    $global_theme_path_a = mysql_fetch_array($global_theme_path);
    
    echo "<tr><td class='themes_small'><a href='viewtopic.php?g=".$global_theme_path_a['id_global_theme']."&s=".$theme_path_a['id_theme']."&t=".$search_a['id_sub_theme']."&page=0&k=".$k."&add=1'>".$search_a['name']."</a></td>";
    echo "<td class=td_themes>".$search_a['watchings']."</td>";
    echo "<td class='td_themes'>".$count_mess_a['count(id_message)']."</td>";
    echo "<td class='last_mess'>".$last_mess_a['data']."<br><a href='viewprofile.php?user=".$last_mess_a['id_user']."'>".$last_mess_a['login']."</a></td>";
}
while ($search_a = mysql_fetch_array($search));
}
}
else 
if ($radio_box == "themes") 
{
        
    $search = mysql_query("SELECT DISTINCT * from sub_theme where (sub_theme.name like '%".$find."%')");
    $search_a = mysql_fetch_array($search);
     if (mysql_num_rows($search) == 0) echo "<p class='nothemes'>Запрос не дал результатов</p>";
    else
    {
    echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Кол-во просмотров</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>";
do
{
      $count_pages = mysql_query("SELECT count(text) as c from message where id_sub_theme =".$search_a['id_sub_theme']."");
    $count_pages_a = mysql_fetch_array($count_pages);
    $count_ = $count_pages_a['c'];
    $k = ceil($count_ / 10) - 1;
    if ($count_pages_a['c'] == 0) $k = 0;
    $count_mess = mysql_query("SELECT count(id_message) from message,sub_theme where message.id_sub_theme=sub_theme.id_sub_theme and sub_theme.id_sub_theme=".$search_a['id_sub_theme']."");
    $count_mess_a = mysql_fetch_array($count_mess);
    
    
    $last_mess = mysql_query("SELECT message.data,users.login,sub_theme.id_sub_theme,users.id_user from message,sub_theme,users where
                              message.id_sub_theme=sub_theme.id_sub_theme and message.id_user=users.id_user 
                              and sub_theme.id_sub_theme=".$search_a['id_sub_theme']."  order by message.data limit 1");
    $last_mess_a = mysql_fetch_array($last_mess);
    
    $theme_path = mysql_query("SELECT * FROM theme,sub_theme where sub_theme.id_sub_theme = ".$search_a['id_sub_theme']." and sub_theme.id_theme = theme.id_theme ");
    $theme_path_a = mysql_fetch_array($theme_path);
    $global_theme_path = mysql_query("SELECT * FROM theme,global_theme where theme.id_theme = ".$theme_path_a['id_theme']." and global_theme.id_global_theme = theme.id_global_theme");
    $global_theme_path_a = mysql_fetch_array($global_theme_path);
    
    echo "<tr><td class='themes_small'><a href='viewtopic.php?g=".$global_theme_path_a['id_global_theme']."&s=".$theme_path_a['id_theme']."&t=".$search_a['id_sub_theme']."&page=0&k=".$k."&add=1'>".$search_a['name']."</a></td>";
    echo "<td class=td_themes>".$search_a['watchings']."</td>";
    echo "<td class='td_themes'>".$count_mess_a['count(id_message)']."</td>";
    echo "<td class='last_mess'>".$last_mess_a['data']."<br><a href='viewprofile.php?user=".$last_mess_a['id_user']."'>".$last_mess_a['login']."</a></td>";
}
while ($search_a = mysql_fetch_array($search));
}
}
else 
if ($radio_box == "mess")
{
            
    $search = mysql_query("SELECT distinct * from message where text like '%".$find."%'");
    $search_a = mysql_fetch_array($search);
     if (mysql_num_rows($search) == 0) echo "<table><p class='nothemes'>Запрос не дал результатов</p></table>";
    else
    {
    echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Кол-во просмотров</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>";
do
{
      $count_pages = mysql_query("SELECT count(text) as c from message where id_sub_theme =".$search_a['id_sub_theme']."");
    $count_pages_a = mysql_fetch_array($count_pages);
    $count_ = $count_pages_a['c'];
    $k = ceil($count_ / 10) - 1;
    if ($count_pages_a['c'] == 0) $k = 0;
    $count_mess = mysql_query("SELECT count(id_message) from message,sub_theme where message.id_sub_theme=sub_theme.id_sub_theme and sub_theme.id_sub_theme=".$search_a['id_sub_theme']."");
    $count_mess_a = mysql_fetch_array($count_mess);
    
    
    $last_mess = mysql_query("SELECT message.data,users.login,sub_theme.id_sub_theme,users.id_user from message,sub_theme,users where
                              message.id_sub_theme=sub_theme.id_sub_theme and message.id_user=users.id_user 
                              and sub_theme.id_sub_theme=".$search_a['id_sub_theme']."  order by message.data limit 1");
    $last_mess_a = mysql_fetch_array($last_mess);
    
    $theme_path = mysql_query("SELECT sub_theme.name,theme.id_theme,sub_theme.watchings FROM theme,sub_theme where sub_theme.id_sub_theme = ".$search_a['id_sub_theme']." and sub_theme.id_theme = theme.id_theme ");
    $theme_path_a = mysql_fetch_array($theme_path);
    $global_theme_path = mysql_query("SELECT * FROM theme,global_theme where theme.id_theme = ".$theme_path_a['id_theme']." and global_theme.id_global_theme = theme.id_global_theme");
    $global_theme_path_a = mysql_fetch_array($global_theme_path);
    
    echo "<tr><td class='themes_small'><a href='viewtopic.php?g=".$global_theme_path_a['id_global_theme']."&s=".$theme_path_a['id_theme']."&t=".$search_a['id_sub_theme']."&page=0&k=".$k."&add=1'>".$theme_path_a['name']."</a></td>";
    echo "<td class=td_themes>".$theme_path_a['watchings']."</td>";
    echo "<td class='td_themes'>".$count_mess_a['count(id_message)']."</td>";
    echo "<td class='last_mess'>".$last_mess_a['data']."<br><a href='viewprofile.php?user=".$last_mess_a['id_user']."'>".$last_mess_a['login']."</a></td>";
}
while ($search_a = mysql_fetch_array($search));
}
}
include "table_foot.php";
include "footer.php";
?>