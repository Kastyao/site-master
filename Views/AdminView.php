<?php 
session_start();
require_once 'HeaderView.php';
require_once '../Includes/Scripts/autoload.php';
$adminController = new AdminController();
?>
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
      <aside>
        <!-- ########################################################################################## -->
        <h2>Администрирование</h2>
        <nav>
          <ul>
            <li><a href="AdminView.php?action=institutes">Институты</a></li>
            <li><a href="AdminView.php?action=faculties">Факультеты</a></li>
            <li><a href="AdminView.php?action=chairs">Кафедры</a>
          </ul>
        </nav>
        <nav>
          <ul>
            <li><a href="AdminView.php?action=teachers">Преподаватели</a>
            <li><a href="AdminView.php?action=students">Студенты</a></li>
            <li><a href="AdminView.php?action=subjects">Предметы</a></li>
          </ul>
        </nav>
        <!-- /nav -->
        <!-- ########################################################################################## -->
      </aside>
    </div>
    <!-- ################################################################################################ -->
    <div class="three_quarter">
   
      <section class="clear">
      	<?=$adminController->checkContent();?>
      </section>
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php require_once 'FooterView.php';?>