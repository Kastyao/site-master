<?php
include "config/config.php";
include "header.php";
include "menu.php";
echo "<center><a href='privates.php?mess=inbox'>Входящие</a> | <a href='privates.php?mess=outbox'>Исходящие</a></center>";


if ($_GET['mess'] == "inbox" || !isset($_GET['mess']))
{
    echo "<table><tr><td class='begin_table_theme'>Тема</td><td class='begin_table_author'>От кого</td><td class='begin_table_data'>Дата</td><td class='delete_private_mess'></td></tr>";
$selected_user_private_mess = mysql_query("SELECT * FROM private_messages_inbox where id_user_get = ".$_SESSION['id_user']." order by data desc");
$selected_user_private_mess_a = mysql_fetch_array($selected_user_private_mess);
}
else if ($_GET['mess'] == "outbox")
{
    echo "<table><tr><td class='begin_table_theme'>Тема</td><td class='begin_table_author'>Кому</td><td class='begin_table_data'>Дата</td><td class='delete_private_mess'></td></tr>";
$selected_user_private_mess = mysql_query("SELECT * FROM private_messages_outbox where id_user_send = ".$_SESSION['id_user']." order by data desc");
$selected_user_private_mess_a = mysql_fetch_array($selected_user_private_mess);
}
else if (!isset($_GET['mess']))
{
    $selected_user_private_mess = mysql_query("SELECT * FROM private_messages where id_user_get = ".$_SESSION['id_user']."");
$selected_user_private_mess_a = mysql_fetch_array($selected_user_private_mess);

}

if (mysql_num_rows($selected_user_private_mess) == 0 && $_GET['mess'] == "outbox") echo "<center><table><p class='create'>Исходящих сообщений нет</p></table></center>";
else if (mysql_num_rows($selected_user_private_mess) == 0 && $_GET['mess'] == "inbox" || !isset($_GET['mess'])) echo "<center><table><p class='create'>Входящих сообщений нет</p></table></center>";
else
do
{
    $select_send_user = mysql_query("SELECT * FROM users where id_user = ".$selected_user_private_mess_a['id_user_send']."");
$select_send_user_a = mysql_fetch_array($select_send_user);
$select_get_user = mysql_query("SELECT * FROM users where id_user = ".$selected_user_private_mess_a['id_user_get']."");
$select_get_user_a = mysql_fetch_array($select_get_user);
if ($selected_user_private_mess_a['read_'] == 0)  echo "<tr><td bgcolor=F0E68C>";
else
    echo "<tr><td>";
    if ($_GET['mess'] == "outbox") echo "<a href='read_privates.php?id_private=".$selected_user_private_mess_a['id_private_messages']."&i=1'>".$selected_user_private_mess_a['theme']."</a></td>";
    else echo "<a href='read_privates.php?id_private=".$selected_user_private_mess_a['id_private_messages']."&mess=".$_GET['mess']."'>".$selected_user_private_mess_a['theme']."</a></td>";
    
    if ($_GET['mess'] == "outbox")
    {
     if ($selected_user_private_mess_a['read_'] == 0) echo "<td class='private_answer_user' bgcolor='F0E68C'>".$select_get_user_a['login']."</td>";
     else echo "<td class='private_answer_user'>".$select_get_user_a['login']."</td>";
     }
    else
    {
        if ($selected_user_private_mess_a['read_'] == 0) echo "<td class='private_answer_user' bgcolor='F0E68C'>".$select_send_user_a['login']."</td>"; 
        else
        echo "<td class='private_answer_user'>".$select_send_user_a['login']."</td>"; 
    }
    
    if ($selected_user_private_mess_a['read_'] == 0) echo "<td class='private_answer_user' bgcolor='F0E68C'>".$selected_user_private_mess_a['data']."</td>";
    else echo "<td class='private_answer_user'>".$selected_user_private_mess_a['data']."</td>";
    
    echo "<td class='private_answer_user'><a href='delete_privates.php?id_private=".$selected_user_private_mess_a['id_private_messages']."&mess=".$_GET['mess']."'><img src='images/delete_mess.gif' title='Удалить'></a></td></tr>";
}
while ($selected_user_private_mess_a = mysql_fetch_array($selected_user_private_mess));
include "table_foot.php";
echo "<table><tr><td class='new_private_mess'><a href='send_private_message.php?i=1'><img src='images/msg_newpost.gif'></a></td></tr></table>";
include "footer.php";

?>