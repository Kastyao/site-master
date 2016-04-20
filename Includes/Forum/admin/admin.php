<?php
//session_start();
include "../config/config.php";
include "header.php";
include "menu.php";

echo "<center><a href='add_global_theme.php'>Добавить глобальную тему</a><br>";
echo "<a href='add_theme.php'>Добавить тему</a><br>";
echo "<a href='add_sub_theme.php'>Добавить подтему</a><br></center>";
include "footer.php";
?>