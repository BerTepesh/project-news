<?
	include 'config.php';
	include $_SERVER['DOCUMENT_ROOT'].'/news/classes/news.php';
?>

<!doctype html>
<html lang="ru">
<head>
   <title>Новости</title>
   <meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	 <link rel="stylesheet" href="<? $_SERVER['DOCUMENT_ROOT'] ?>/stylesheets/main.css" />
</head>
<body>
	<div class="wrap">
		<div class="container">
			<div class="news">
				<h1>Новости</h1>
				<div class="news__control">
					<div class="news__add">
						<form action="add/">
							<button type="submit">Добавить новость</button>
						</form>
					</div>
					<div class="news__sort">
						<span>Сортировать по дате: &nbsp;</span>
						<form action="?sort=id ASC" method="post">
							<button type="submit">возр</button>
						</form>
						<form action="?sort=id DESC" method="post">
							<button type="submit">убыв</button>
						</form>
					</div>
				</div>
				<div class="news__list row">
					<?
						$sort = $_GET['sort'];
						$news = new News(SERVER,USER,PASS,DBNAME,TABLENAME);
						$news->showAll($sort);
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>