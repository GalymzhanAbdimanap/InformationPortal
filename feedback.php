﻿<?php 
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

	<li><a href="index.php">Новости</a></li>
	<li><a href="article.php">Статьи</a></li>
	<li><a href="about.php">О нас</a></li>
	<li><a href="feedback.php" class="active">Обратная связь</a></li>
	<li><a href="vhod.php">Вход</a></li>
	<li><a href="reg.php">Регистрация</a></li>
	<hr>
	<h4>Последние новости</h4>
	<?php
		$query_fresh_news = mysql_query("SELECT * FROM news LIMIT 3");
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
		

		<div class="feedback">
			<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" >
			<h2 style = "text-align:center;">Обратная связь</h2>
			<p>Имя: <input type = "text" name = "name" placeholder = "Введите ваше имя" ></p><br>
			<p>E-mail: <input type = "text" name = "email" placeholder = "Введите вашу почту" required = ""><span class = "required">*</span></p><br>
			<p>Сообщение: <textarea name="message" required = ""></textarea><span class = "required">*</span></p><br>
			<button type = "submit" name = "submit">Отправить</button><br><br>
			</form>
			<?php 
			if(isset($_POST['submit'])){
				$name=htmlspecialchars(trim($_POST['name']));
				$email=htmlspecialchars(trim($_POST['email']));
				$message=htmlspecialchars(trim($_POST['message']));
				if(!empty($name) && !empty($email) &&!empty($message)){
					$query=mysql_query("INSERT INTO feedback (name, email, message) VALUES ('$name',  '$email', '$message')");
				}
			}
			?>
			
			
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