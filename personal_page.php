<?php 
require_once("bd.php");
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<title>PORTAL OF NEWS</title>
<meta charset="utf8"  content="text/html">
<link href ="css/style.css"   rel="stylesheet" type="text/css">
</head>
<body>
<div class="container">
	<div class ="header">
	<h1>Ip</h1>
	<h2>Информационный портал</h2>
	</div>
	<div class = "menu">
	<ul><h2>МЕНЮ</h2>

	<li><a href="index.php" class="active">Новости</a></li>
	<li><a href="article.php">Статьи</a></li>
	<li><a href="about.php">О нас</a></li>
	<li><a href="feedback.php">Обратная связь</a></li>
	<li><a href="vhod.php">Вход</a></li>
	<li><a href="reg.php">Регистрация</a></li>
	<hr>
	<h4>Последние новости</h4>
	<?php
		$query_fresh_news = mysql_query("SELECT * FROM news ORDER BY data DESC  LIMIT 3");
	?>
		<?php while($row_fresh_news = mysql_fetch_assoc($query_fresh_news)):?>
		<div class="fresh_news">
			<li><a href="news.php?id_news=<?=$row_fresh_news['id'];?>"><?=$row_fresh_news['title'];?></a></li>
		</div>
		<?php endwhile;?>
	<form action = "search.php" method = "POST">
	<input type="text" name="search" placeholder="Поиск" size="9px">
	<button type="submit">Найти</button>
	</form>
	</ul>
	
	</div>
	<div class = "content">
		<h1>Добро пожаловать на наш портал!</h1>
		<?php
		$query_userlist = mysql_query("SELECT * FROM userlist WHERE login = '".$_SESSION['login']."'");
		$row_userlist = mysql_fetch_assoc($query_userlist);
		?>
		
		<div class="toplist" style = "height:500px; padding-top:20px;">
			<p>Имя:<?=$row_userlist['name'];?></p>
			<p>Фамилия:<?=$row_userlist['last_name'];?></p>
			<p>E-mail:<?=$row_userlist['email'];?></p>
			<p>Логин:<?= $_SESSION['login'];?></p>
			<p>Пароль:<?= $_SESSION['password'];?></p>
			
		</div>
		
	</div>
	<div class="clearfix"></div><br><br>


	
</div>
<div class="footer">
	
<p>Все права защищены</p>
</div>
</div>

</body>
</html>