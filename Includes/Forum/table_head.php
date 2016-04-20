<?php

include "config/config.php";

if ($_SESSION['username'] == "admin" && !isset($_GET['t']) && !isset($_GET['s']))
{
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Тем</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>
<td class='table_head' id='td_admin' width='20'>Админ меню</td>";
}
else
if ($_SESSION['moderator'] == 1 && isset($_GET['t']) && !isset($_GET['s']))
{
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Тем</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>
<td class='table_head' width='20'>Админ меню</td>";
}
else if ($_SESSION['moderator'] == 1 && isset($_GET['t']) && isset($_GET['s']) )
{
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Просмотров</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>
<td class='table_head' width='20'>Админ меню</td>";
}
else if (isset($_GET['s']) && $_SESSION['moderator'] == 0) 
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Просмотров</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>";
else
if (isset($_GET['t']) && isset($_GET['s'])) 
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Просмотров</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>";
else
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>Раздел</td>
<td class='table_head' width='40'>Тем</td>
<td class='table_head' width='40'>Сообщений</td>
<td class='table_head' width='80'>Последнее сообщение</td>
</tr>";
?>