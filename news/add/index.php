<?
	include '../config.php';
	include $_SERVER['DOCUMENT_ROOT'].'/news/classes/news.php';
?>

<!doctype html>
<html lang="ru">
<head>
   <title>Добавить новость</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
	<link rel="stylesheet" href="<? $_SERVER['DOCUMENT_ROOT'] ?>/stylesheets/main.css" />
</head>
<body>
	<div class="wrap">
		<div class="container">
			<div class="news-form">
					<h1>Добавить новость</h1>
					<?
                  if ( isset($_POST['add']) ) {

                     $title   = $_POST['title'];
                     $date    = $_POST['date'];
                     $image   = $_POST['image'];
                     $text    = $_POST['text'];

                     if($title && $date && $text) {

                        $src = array($title, $date, $image, $text);
                        $dest = array('title', 'date', 'image', 'text');

                        $news = new News(SERVER,USER,PASS,DBNAME,TABLENAME);
                                
                        if($news->add($dest, $src)) {
                           echo "<div class='news-form__result done'>Добавленно</div> <br>";
                        } else {
                           echo "<div class='news-form__result error'>Не удалось добавить</div> <br>";
                        }
                     } else {
                        echo "<div class='news-form__result error'>Не заполнены обязательные поля</div> <br>";
                     }
                  } 
					?>
					<form name="form_add" method="post" action="" class="form">
                  <div class="form-control">
                     <label for="title">
                           Заголовок<sup>*</sup><br/>
                           <input type="text" name="title" id="title" placeholder="Введите заголовок" value="">
                     </label>
                  </div>
                  <div class="form-control">
                     <label for="date">
                           Дата<sup>*</sup><br/>
                           <input type="date" id="date" name="date" placeholder="<?php echo date ('Y-m-d');?>" value="<?php echo date ('Y-m-d');?>">
                     </label>
                  </div>
                  <div class="form-control">
                     <label for="image" class="news-edit__image">
                           Изображение<br/>
                           <input type="file" id="image" name="image" placeholder="Выберете изображение" value="">
                     </label>
                  </div>
						<div class="form-control">
                     <label for="text">
                           Текст новости<sup>*</sup><br/>
                           <textarea id="text" name="text" placeholder="Введите текст новости" cols="30" rows="5"></textarea>
                     </label>
                  </div>

                  <p class="news-form__hint">Обязательно для заполнения<sup>*</sup></p>

						<input type="submit" id="add" name="add" value="Добавить">
					</form>
               <a href="/news/">Назад</a>
			</div>
		</div>
	</div>
</body>
</html>
