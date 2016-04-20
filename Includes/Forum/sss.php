<?php
include "config/config.php";

	$smiles = scandir ("images/smiles");
	for($i = 0; $i < count($smiles); $i++)
    {
		if($smiles[$i] != "." && $smiles[$i] != ".." &&  $smiles[$i] != "Thumbs.db")
		{
		  $g = strpos($smiles[$i],".gif");
          echo $g;
		  $s[$i] = substr($smiles[$i],0,strlen($smiles[$i])-4);
          echo("<img border=0 src='images/smilies/$smiles[$i]' style='cursor:pointer' onClick=\"add_smiles('".$smiles[$i]."')\">&nbsp&nbsp&nbsp");
            $m = mysql_query("INSERT into smiles(smile,dvoe) values('".$smiles[$i]."',':".$s[$i].":')");}
    }
    
?>
