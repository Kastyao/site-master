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
������� �������� ����  <br><br><input type='text' name='name'><br><br>
<input type='submit' value='�������'>
</form></center>";
}
if ($c == 1)
{
    echo "<p class=create>���������� ���� ������� �������</p>";
    echo "<center><a href='add_global_theme.php'>������� ��� ����</a><br>";
    echo "<a href='admin.php'>��������� � ����� ����</a><center>";
}

include "footer.php";
?>