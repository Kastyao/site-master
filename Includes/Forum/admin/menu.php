<?php
session_start();
if ($_SESSION['enter']!=1)
{
echo "<div id='topmenu'>
			<ul><li>
<a href='enter.php'>Вход</a>

<a href='reg.php'>Регистрация</a></li>
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
Добро пожаловать,<span>".$_SESSION['username']."</span>&nbsp;&nbsp;</li>
			</ul>
            <ul><a href='profile.php'>Профиль</a></ul>
            <ul>&nbsp;&nbsp;<a href='admin/admin.php'>Админ часть</a></ul>
            <ul>&nbsp;&nbsp;<a href='exit.php'>Выход</a></ul>
            
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
Добро пожаловать,<span>".$_SESSION['username']."</span>&nbsp;&nbsp;</li>
			</ul>
            <ul><a href='profile.php'>Профиль</a></ul>
            <ul>&nbsp;&nbsp;<a href='exit.php'>Выход</a></ul>
            
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