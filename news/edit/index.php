<?
	include '../config.php';
	include $_SERVER['DOCUMENT_ROOT'].'/news/classes/news.php';
?>

<!doctype html>
<html lang="ru">
<head>
   <title>Изменить новость</title>
   <meta charset="utf-8">
	 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	 <link rel="stylesheet" href="<? $_SERVER['DOCUMENT_ROOT'] ?>/stylesheets/main.css" />
</head>
<body>
	<div class="wrap">
		<div class="container">
			<div class="news-form">
					<h1>Изменить новость</h1>
					<?
						$id = (int) $_GET['news_id'];

						if(isset($id)) {

							$news = new News(SERVER,USER,PASS,DBNAME,TABLENAME);
							$newsArticle = $news->select('*',$news->getCurTable(), "id = $id");

							if ( isset($_POST['apply']) ) {

								$title   = $_POST['title'];
								$date    = $_POST['date'];
								$image   = $_POST['image'];
								$text    = $_POST['text'];
	
								if($title && $date && $text) {
									
									$src = array("title = '$title'", "date = '$date'"," image = '$image'", "text = '$text'");
	
									if($news->update($id, $src)) {
										echo "<div class='news-form__result done'>Изменено</div> <br>";
									} else {
										echo "<div class='news-form__result error'>Не удалось изменить</div> <br>";
									}
								} else {
									echo "<div class='news-form__result error'>Не заполнены обязательные поля</div> <br>";
								}
							 } 
	
							if ( isset($_POST['del']) ) {
								if($news->delete($id)) {
										echo "<div class='news-form__result done'>Удалено</div> <br>";
								} else {
										echo "<div class='news-form__result error'>Не удалось удалить</div> <br>";
								}
							} 
						}						 
					?>
					<form name="form_edit" method="post" action="" class="form">
						<div class="form-control">
							<label for="title">
									Заголовок <sup>*</sup><br/>
									<input type="text" name="title" id="title" placeholder="Введите заголовок" value="<? echo $newsArticle[0]['title']?>">
							</label>
						</div>
						<div class="form-control">
							<label for="date">
									Дата<sup>*</sup><br/>
									<input type="date" id="date" name="date" placeholder="<?php echo date ('Y-m-d');?>" value="<? echo $newsArticle[0]['date']?>">
							</label>
						</div>
						<div class="form-control">
							<label for="image" class="news-edit__image">
									Изображение<br/>
									<input type="file" id="image" name="image" placeholder="Выберете изображение" value="<? echo $newsArticle[0]['image']?>">
							</label>
						</div>	
						<div class="form-control">
							<label for="text">
									Текст новости <sup>*</sup><br/>
									<textarea id="text" name="text" placeholder="Введите текст новости" cols="30" rows="5"><? echo $newsArticle[0]['text']?></textarea>
							</label>
						</div>

						<p class="news-form__hint">Обязательно для заполнения<sup>*</sup></p>

						<input type="submit" id="apply" name="apply" value="Применить">
						<input type="submit" id="del" name="del" value="Удалить">
					</form>
					<a href="/news/">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>
