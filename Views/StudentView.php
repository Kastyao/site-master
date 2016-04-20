<?php 
session_start();
require_once 'HeaderView.php';
require_once '../Includes/Scripts/autoload.php';
$studentController = new StudentController();
?>
<div class="wrapper row3">
  <div id="container">
    <!-- ################################################################################################ -->
    <div id="sidebar_1" class="sidebar one_quarter first">
      <aside>
        <!-- ########################################################################################## -->
        <h2>Раздел студента</h2>
        <nav>
          <ul>
            <li><a href="StudentView.php?action=subjects">Предметы</a></li>
            <li><a href="StudentView.php?action=teachers">Преподаватели</a></li>
          </ul>
        </nav>
        <nav>
          <ul>
            <li><a href="StudentView.php?action=profile">Мой профиль</a>
          </ul>
        </nav>
        <!-- /nav -->
        <!-- ########################################################################################## -->
      </aside>
    </div>
    <!-- ################################################################################################ -->
    <div class="three_quarter">
   
      <section class="clear">
      	<?=$studentController->checkContent()?>
      </section>
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </div>
</div>
<?php require_once 'FooterView.php';?>