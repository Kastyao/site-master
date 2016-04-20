	<head>
<script language="javascript" src="java.js"></script>
</head>	
<div id='smiles' style='display:none' class="smiles">
<?php
 $show_smiles = mysql_query("SELECT * from smiles");
 $show_smiles_a = mysql_fetch_array($show_smiles);
 
 do
 {
    echo("<img border=0 src='images/smiles/".$show_smiles_a['smile']."' style='cursor:pointer' onClick=\"add_smiles('".$show_smiles_a['smile']."')\">&nbsp&nbsp&nbsp");
 }
 while ( $show_smiles_a = mysql_fetch_array($show_smiles));
?>
</div>