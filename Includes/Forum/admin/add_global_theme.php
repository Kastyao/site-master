<?php
error_reporting(0);
include "../config/config.php";
include "header.php";
include "menu.php";
$c = 0;
$name = $_POST['name'];
if (isset($name) && $name != "")
{
    $add = mysql_query("INSERT into global_theme(name) values('$name')");
    if ($add) {$c = 1;$name="";};
}
if ($c == 0)
{
echo "<center><form action='add_global_theme.php' method='POST'>
Введите название темы  <br><br><input type='text' name='name'><br><br>
<input type='submit' value='Создать'>
</form></center>";
}
if ($c == 1)
{
    echo "<p class=create>Глобальная тема успешно создана</p>";
    echo "<center><a href='add_global_theme.php'>Создать ещё одну</a><br>";
    echo "<a href='admin.php'>Вернуться в админ меню</a><center>";
}

include "footer.php";
?>