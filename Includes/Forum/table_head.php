<?php

include "config/config.php";

if ($_SESSION['username'] == "admin" && !isset($_GET['t']) && !isset($_GET['s']))
{
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>������</td>
<td class='table_head' width='40'>���</td>
<td class='table_head' width='40'>���������</td>
<td class='table_head' width='80'>��������� ���������</td>
<td class='table_head' id='td_admin' width='20'>����� ����</td>";
}
else
if ($_SESSION['moderator'] == 1 && isset($_GET['t']) && !isset($_GET['s']))
{
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>������</td>
<td class='table_head' width='40'>���</td>
<td class='table_head' width='40'>���������</td>
<td class='table_head' width='80'>��������� ���������</td>
<td class='table_head' width='20'>����� ����</td>";
}
else if ($_SESSION['moderator'] == 1 && isset($_GET['t']) && isset($_GET['s']) )
{
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>������</td>
<td class='table_head' width='40'>����������</td>
<td class='table_head' width='40'>���������</td>
<td class='table_head' width='80'>��������� ���������</td>
<td class='table_head' width='20'>����� ����</td>";
}
else if (isset($_GET['s']) && $_SESSION['moderator'] == 0) 
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>������</td>
<td class='table_head' width='40'>����������</td>
<td class='table_head' width='40'>���������</td>
<td class='table_head' width='80'>��������� ���������</td>";
else
if (isset($_GET['t']) && isset($_GET['s'])) 
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>������</td>
<td class='table_head' width='40'>����������</td>
<td class='table_head' width='40'>���������</td>
<td class='table_head' width='80'>��������� ���������</td>";
else
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>������</td>
<td class='table_head' width='40'>���</td>
<td class='table_head' width='40'>���������</td>
<td class='table_head' width='80'>��������� ���������</td>
</tr>";
?>