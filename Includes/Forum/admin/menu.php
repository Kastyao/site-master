<?php
session_start();
if ($_SESSION['enter']!=1)
{
echo "<div id='topmenu'>
			<ul><li>
<a href='enter.php'>����</a>

<a href='reg.php'>�����������</a></li>
			</ul>
		</div>
        </div>
				</div>
			</div>
			<div id='bodybox'>
				<div id='bdybox-l'>
					<div id='bdybox-b'>
						<div id='bdybox-br'>
							<div id='bdybox-bl'>
								<div id='bdybox-t'>
									<div id='bdybox-tr'>
										<div id='bdybox-tl'>";
}
else if ($_SESSION['username'] == "admin" && $_SESSION['enter'])
{
    echo "<div id='topmenu'>
			<ul><li>
����� ����������,<span>".$_SESSION['username']."</span>&nbsp;&nbsp;</li>
			</ul>
            <ul><a href='profile.php'>�������</a></ul>
            <ul>&nbsp;&nbsp;<a href='admin/admin.php'>����� �����</a></ul>
            <ul>&nbsp;&nbsp;<a href='exit.php'>�����</a></ul>
            
		</div>
        </div>
				</div>
			</div>
			<div id='bodybox'>
				<div id='bdybox-l'>
					<div id='bdybox-b'>
						<div id='bdybox-br'>
							<div id='bdybox-bl'>
								<div id='bdybox-t'>
									<div id='bdybox-tr'>
										<div id='bdybox-tl'>";  
    
}
else
if ($_SESSION['enter'] == 1)
{
    echo "<div id='topmenu'>
			<ul><li>
����� ����������,<span>".$_SESSION['username']."</span>&nbsp;&nbsp;</li>
			</ul>
            <ul><a href='profile.php'>�������</a></ul>
            <ul>&nbsp;&nbsp;<a href='exit.php'>�����</a></ul>
            
		</div>
        </div>
				</div>
			</div>
			<div id='bodybox'>
				<div id='bdybox-l'>
					<div id='bdybox-b'>
						<div id='bdybox-br'>
							<div id='bdybox-bl'>
								<div id='bdybox-t'>
									<div id='bdybox-tr'>
										<div id='bdybox-tl'>";
}
                                        
?>