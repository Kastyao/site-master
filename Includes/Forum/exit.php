 
 <?php

  session_start();
  include "config/config.php";
  unset($_SESSION['username']); 
  unset($_SESSION['enter']);
  $put_offline = mysql_query("UPDATE users set online=0 where id_user=".$_SESSION['id_user']."");
  unset($_SESSION['id_user']);
  unset ($_SESSION['moderator']);
  
  echo "<script language=JavaScript>window.location='index.php';</script>"; 
  session_destroy();
  
  ?>