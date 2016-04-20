<script language="javascript" src="jquery-latest.js">
</script>

<script>
c=setInterval("checkOnline()",1500);
function checkOnline()
{
  $.post("online.php");
  
}
</script>


