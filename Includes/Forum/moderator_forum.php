<?php

include "config/config.php";

if ($_SESSION['moderator'] == 1 && $_SESSION['username'] != "admin")
{
echo "</table><br><table width=100%>
<tr>
<td class='table_moderator' width='100%'>������������� ������</td></table>";
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>������</td>
<td class='table_head' width='40'>���</td>
<td class='table_head' width='40'>���������</td>
<td class='table_head' width='80'>��������� ���������</td>";
}
else 
if ($_SESSION['moderator'] == 1 && $_SESSION['username'] == "admin")
{
echo "</table><br><table width=100%>
<tr>
<td class='table_moderator' width='100%'>������������� ������</td></table>";
echo "<table width=100%>
<tr>
<td class='table_head' width='100'>������</td>
<td class='table_head' width='40'>���</td>
<td class='table_head' width='40'>���������</td>
<td class='table_head' width='80'>��������� ���������</td>
<td class='table_head' width='20'>����� ����</td>";
}


?>