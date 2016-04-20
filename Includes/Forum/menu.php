<?php
session_start();
error_reporting(0);
if ($_SESSION['enter']!=1)
{
echo "<div id='topmenu'>
			<ul><li>
            <center><form method='POST' action='enter.php'>
<input name='login' value='Логин' onfocus='this.value = '';' onblur='if(this.value=='Логин') this.value='Логин';' type='text'>
<input type=password value='Пароль' onfocus='this.value = '';' size=15 name='password'>
<input type='submit' value='Войти'></form></center></li><li>

<a href='reg.php'>Регистрация</a></li>
<li><a href='search.php'>Поиск</a></li>
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
Добро пожаловать,<span style='color:blue;font-style:italic;'>".$_SESSION['username']."</span>&nbsp;&nbsp;</li>
			</ul>
            <ul><a href='viewprofile.php'>Профиль</a></ul>
            <ul>&nbsp;&nbsp;<a href='admin.php'>Админ часть</a></ul>
            <ul>&nbsp;&nbsp;<a href='privates.php?mess=inbox'>Личные сообщения";
            $selected_user_private_mess = mysql_query("SELECT count(text) FROM private_messages_inbox where id_user_get = ".$_SESSION['id_user']." and read_=0");
            $selected_user_private_mess_a = mysql_fetch_array($selected_user_private_mess);
          
            echo "<span style=color:blue>(".$selected_user_private_mess_a['count(text)'].")</span></a></ul><ul>&nbsp;&nbsp;<a href='search.php'>Поиск</a></ul>
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
Добро пожаловать,<span style='color:blue;font-style:italic;'>".$_SESSION['username']."</span>&nbsp;&nbsp;</li>
			</ul>
            <ul><a href='viewprofile.php'>Профиль</a></ul>
            <ul>&nbsp;&nbsp;<a href='privates.php?mess=inbox'>Личные сообщения";
            $selected_user_private_mess = mysql_query("SELECT count(text) FROM private_messages_inbox where id_user_get = ".$_SESSION['id_user']." and read_=0");
            $selected_user_private_mess_a = mysql_fetch_array($selected_user_private_mess);
          
            echo "<span style=color:blue>(".$selected_user_private_mess_a['count(text)'].")</span></a></ul><ul>&nbsp;&nbsp;<a href='search.php'>Поиск</a></ul>
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