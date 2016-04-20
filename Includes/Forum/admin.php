<?php
//session_start();
include "config/config.php";
include "header.php";
include "menu.php";

echo "<center><a href='change_privileges.php'>Изменить права пользователя</a><br>";
echo "<a href='ban.php'>Бан пользователей</a><br>";
echo "<a href='unban.php'>Разбан пользователей</a><br></center>";
include "footer.php";
?>