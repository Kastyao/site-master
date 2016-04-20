<?php

include "config/config.php";

if ($_SESSION['moderator'] == 1 && $_SESSION['username'] != "admin")
{
echo "</table><br><table width=100%>
<tr>
<td class='table_moderator' width='100%'>Модераторский раздел</td></table>";
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Тем</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>";
}
else 
if ($_SESSION['moderator'] == 1 && $_SESSION['username'] == "admin")
{
echo "</table><br><table width=100%>
<tr>
<td class='table_moderator' width='100%'>Модераторский раздел</td></table>";
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Тем</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>
<td class='table_head' width='20'>Админ меню</td>";
}


?>