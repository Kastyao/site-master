<?php 
session_start();
	require_once '../Includes/Scripts/autoload.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>RS-1200 Prototype 20</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../Includes/Template/layout/styles/main.css" rel="stylesheet" type="text/css" media="all">
<link href="../Includes/CSS/jquery-ui-1.10.2.custom.css" rel="stylesheet" type="text/css" media="all">

<link href="../Includes/Template/layout/styles/mediaqueries.css" rel="stylesheet" type="text/css" media="all">
<!--[if lt IE 9]>
<link href="layout/styles/ie/ie8.css" rel="stylesheet" type="text/css" media="all">
<script src="layout/scripts/ie/css3-mediaqueries.min.js"></script>
<script src="layout/scripts/ie/html5shiv.min.js"></script>
<![endif]-->

<script type="text/javascript" src="../Includes/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="../Includes/ckeditor/config.js"></script>


</head>
<body class="">
  

<?php 
		session_start();
		require_once '../Includes/Scripts/autoload.php';
		$teachersController = new TeacherController();
		$teachersController->checkContent();
?>
<!-- Scripts -->
<script src="../Includes/Scripts/jquery-1.9.1.js"></script>
<script src="../Includes/Scripts/jquery-ui-1.10.2.custom.js"></script>
<script src="../Includes/Scripts/jquery.ui.datepicker-ru.js"></script>

<script src="../Includes/Scripts/scripts.js"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script>window.jQuery || document.write('<script src="layout/scripts/jquery-latest.min.js"><\/script>\
<script src="../Includes/Template/layout/scripts/jquery-ui.min.js"><\/script>')</script>
<script>jQuery(document).ready(function($){ $('img').removeAttr('width height'); });</script>
<script src="../Includes/Template/layout/scripts/jquery-mobilemenu.min.js"></script>
<script src="../Includes/Template/layout/scripts/custom.js"></script>
</body>

</html>