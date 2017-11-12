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
<script type = "text/javascript" src = "http://code.jquery.com/jquery-latest.js">
</script>
</head>
<body>
<div class="container">
	<div class ="header">
	<h1>Ip</h1>
	<h2>Информационный портал</h2>
	</div>
	<div class = "menu">
	<ul><h2>МЕНЮ</h2>

	<li><a href="index.php" >Новости</a></li>
	<li><a href="article.php" class="active">Статьи</a></li>
	<li><a href="about.php">О нас</a></li>
	<li><a href="feedback.php">Обратная связь</a></li>
	<li><a href="vhod.php">Вход</a></li>
	<li><a href="reg.php">Регистрация</a></li>
	<hr>
	<h4>Последние новости</h4>
	<?php
		$query_fresh_news = mysql_query("SELECT * FROM news ORDER BY data DESC LIMIT 3");
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
		if(isset($_GET['id_articles'])){$id_articles = $_GET['id_articles'];}
		$query_articles = mysql_query("SELECT * FROM articles WHERE id ='$id_articles' ");
		$row_articles = mysql_fetch_assoc($query_articles);
		?>

		<div class="toplist">
			<h2><?=$row_articles['title'];?></h2>
			<p><span style="margin-right:25px;"><b>автор:</b> <?=$row_articles['aftor'];?></span><span  style="margin-right:25px;"><b>дата:</b> <?=$row_articles['data'];?></span><span  style="margin-right:25px;"><b>Количество просмотров:</b> <?=$row_articles['prosmotr'];?></span><span style="margin-right:25px;"><b>Комментарии:</b> <?=$row_articles['comentt'];?></span></p>
			<p><?=$row_articles['text'];?><br><br></p>
			<?php 
			$prosmotre = $row_articles['prosmotr'];
			$prosmotre++;
			$update2 = mysql_query("UPDATE articles SET prosmotr = '$prosmotre' WHERE id = '$id_articles'");
			?>
		</div>
		<div class="toplist"><br>
		<?php 
			$query_comments = mysql_query("SELECT * FROM comments WHERE id_articles = '$id_articles'");
		?>
		<?php while($row_comments = mysql_fetch_assoc($query_comments)):?>
			<p><?php echo $row_comments['name'];?>:
			<?php echo $row_comments['comments'];?></p><br>
		<?php endwhile ;?>
		</div>
		<div class="toplist">
		
		
			<form action = "article_2.php?id_articles=<?=$row_articles['id']?>" method = "POST"><br>
				<label>Ваше имя <input type = "text" name = "name"></label><br><hr>
				<label>Комментарии <textarea  rows = "3" name = "comments"></textarea></label>
			<button type = "submit" name = "submit"  >Отправить</button>
			</form>
			<?php
			if(isset($_POST['submit'])){
			$name = htmlspecialchars(trim($_POST['name']));
			$comments = htmlspecialchars(trim($_POST['comments']));	
			$query = mysql_query("INSERT INTO comments (name , comments, id_articles) VALUES('$name', '$comments', '$id_articles')");
			$comentt = $row_articles['comentt'];
			$comentt++;
			$update3 = mysql_query("UPDATE articles SET comentt = '$comentt' WHERE id = '$id_articles'");
			echo "<html>";
			echo "<head>";
			echo '<meta http-equiv="refresh" content="1;URL=http://localhost/blog/article_2.php?id_articles='.$row_articles['id'].'">';
			echo "</head>";
			echo "</html>";
			exit();
			
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