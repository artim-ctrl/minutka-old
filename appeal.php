<?php
	require ('db.php');

	$data = $_POST;
	if (isset($_SESSION['logged_user'])) {
		if (isset($data['send'])) {
			if (trim($data['topic_of_appeal']) == '') {
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите тему обращения!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			} else if (trim ($data['appeal_text']) == '') {
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите текст обращения!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			} else {
				$subject = $data['topic_of_appeal'];
				$to = "derenko2@gmail.com";
				$user = R::findOne('users', 'user_email = ?', array($_SESSION['logged_user']['user_email']));
				$message = $data['appeal_text']."
				From
				"."E-mail: ".$user['user_email']."
				Name: ".$user['user_name']."
				Phone: ".$user['user_phone']."
				Vin-code: ".$user['user_vin'];
				mail ($to, $subject, $message);
				echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Сообщение отправлено!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			}
		}
	} else {
		header ("Location: autorization.php");
	}
?>


<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Автосервис "Минутка"</title>
	<style>
		body {
			background: #3a2820 url("img/background.png") center no-repeat fixed;
			background-size: cover;
		}
	</style>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" media="screen,projection" href="css/ui.totop.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" href="css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
</head>
<body>
<div class="content">
	
	
	<!--Навигационная панель-->
	<nav class="navbar navbar-expand-lg navbar-light">
		<a class="navbar-brand" href="index.php"><img id="logo" src="img/logo.png" alt=""></a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="index.php">Главная</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="news.php">Новости</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="carparts.php">Автозапчасти</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="services.php">Услуги</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="reviews.php">Отзывы</a>
				</li>
				<li class="nav-item">
                    <a class="nav-link btn_" href="/appeal.php">Обратиться</a>
				</li>
			</ul>
			<ul class="navbar-nav">
				<li class="nav-link">
					<?php if (isset ($_SESSION['logged_user'])) {echo "Здравствуйте, ".$_SESSION['logged_user']['user_name'];} ?>
				</li>
				<li class="nav-item">
					<a class="nav-link btn_" href="/autorization.php">Личный кабинет</a>
				</li>
			</ul>
		</div>
	</nav>
	
	
	<!--Сама форма входа-->
	<div class="container" style="text-align: center; margin-top: 20px; background-color: #000; padding: 30px 20px; border-radius: 10px; border: 1px solid #ccc">
		<form class="needs-validation" action="/appeal.php" method="post" enctype="multipart/form-data" novalidate>
			<div class="form-row">
      			<div class="col-md-12 mb-3">
      				<label for="topic_of_appeal">Тема обращения:</label>
      				<input type="text" class="form-control form_" name="topic_of_appeal" id="topic_of_appeal" placeholder="Тема обращения" required>
      				<div class="invalid-tooltip">
        				Введите тему обращения!
      				</div>
    			</div>
			</div>
  			<div class="form-row">
    			<div class="col-md-12 mb-3">
    				<label for="appeal_text">Текст обращения:</label>
    				<textarea class="form-control form_" name="appeal_text" id="appeal_text" placeholder="Текст обращения" style="height: 150px; max-height: 150px" required></textarea>
    				<div class="invalid-feedback">
      					Введите текст обращения!
    				</div>
  				</div>
  			</div>
  			<button class="btn btn_info" type="submit" name="send">Отправить</button>
		</form>
	</div>
	
	
	<div class="container">
    	<div style="background-color: #000; border-radius: 10px; padding: 10px; margin-top: 20px; border: 1px solid #ccc">
    		<h5 style="text-align: justify; padding: 10px 10px">Вы можете отправить нам какое-либо предложение или отзыв на нашу почту, заказать запчасти для Вашего автомобиля, записаться на ремонт, мы ответим Вам на почту или позвоним как только сможем:)</h5>
    	</div>
	</div>

	
</div>
	
	
    <footer class="footer" style="background-color: #000">
		<div>
      		<div class="container" style="padding: 20px 0px">
        		<span class="text-muted" id="spn">Все права защищены &copy 2019</span>
      		</div>
		</div>
    </footer>
	
	
</body>
</html>