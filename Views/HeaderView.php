<?php 
session_start();
	require_once '../Includes/Scripts/autoload.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
<title>ОНУ</title>
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
</head>
<body class="">
<div class="wrapper row1">
  <header id="header" class="full_width clear">
    <hgroup>
      <h1><a href="IndexView.php"><img src="../Includes/Images/1.gif" style="width:80px; float:left;">&nbsp;Одесский Национальный Университет<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; имени И.И.Мечникова</a></h1>
    </hgroup>
    <div id="header-contact">
      
      <?=MainController::getLoginForm();?>
      </div>
    </div>
  </header>
</div>
<!-- ################################################################################################ -->
<div class="wrapper row2">
  <nav id="topnav">
    <ul class="clear">
      <li class="active"><a href="IndexView.php" title="Главная">Главная</a></li>
       <li><a class="drop" href="#" title="Общая информация">Общая информация</a>
       	<ul>
       		<li><a href="" title="История университета">История университета</a></li>
       		<li><a href="" title="Устав университета">Устав университета</a></li>
       		<li><a href="" title="Приветствие ректора ОНУ">Приветствие ректора ОНУ</a></li>
       		<li><a href="" title="Реквизиты">Реквизиты</a></li>
       		<li><a href="" title="Карта университета">Карта университета</a></li>
       		<li><a href="" title="Контакты">Контакты</a></li>
       	</ul>
       	</li>
       <li><a class="drop" href="#" title="Структура университета">Структура университета</a>
       	<ul>
       		<li><a href="" title="Институты">Институты</a></li>
       		<li><a href="" title="Факультеты">Факультеты</a></li>
       		<li><a href="" title="Кафедры">Кафедры</a></li>
       	</ul>
       </li>
       <?=MainController::getExtraMenu();?>
    </ul>
  </nav>
</div>
<!-- content -->
