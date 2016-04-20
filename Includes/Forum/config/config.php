 <?php 
 
 $db = mysql_connect("127.0.0.1","user","Konstantin1");
 mysql_set_charset('cp1251',$db);
  
 if(!$db) echo "MYSQL ERROR";
 mysql_select_db("forum_db",$db);
 
 ?>