<?php
include "config/config.php";
include "header.php";
include "menu.php";
$id_private = $_GET['id_private'];
$mess = $_GET['mess'];

if (isset($id_private))
{
    //if ($_SESSION['id_user'] == $selected_private_a['id_user_send']) $delete_private_mess = mysql_query("DELETE from private_messages where id_private_messages = ".$id_private."");
    
    if ($mess == "inbox")
{
$delete_private_mess = mysql_query("DELETE from private_messages_inbox where id_private_messages = ".$id_private."");
}
else
{
$delete_private_mess = mysql_query("DELETE from private_messages_outbox where id_private_messages = ".$id_private."");
}
    
    echo "<p class='create'>Сообщение успешно удалено</p>";
    if ($_GET['mess']=="inbox") echo '<script language="JavaScript">var f = setTimeout("window.location=\"privates.php?mess=inbox\"",1000);</script>';
    else echo '<script language="JavaScript">var f = setTimeout("window.location=\"privates.php?mess=outbox\"",1000);</script>';
}

include "footer.php";
?>