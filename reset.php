<?php
	require ('db.php');

	$data = $_POST;
	if (isset($_SESSION['random_for_reset_email']) && isset($_SESSION['tmp_email'])){
		if (isset($data['reset'])) {
			if (trim($data['code']) == '') {
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите код восстановления!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			} else if (trim($data['code']) != $_SESSION['random_for_reset_email']) {
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите верный код восстановления!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			} else if (trim($data['code']) == $_SESSION['random_for_reset_email']) {
				//отправить на reset_.php(форма для ввода нового пароля)
				$_SESSION['input_code'] = 'yes';
				header ("Location: reset_.php");
			}
		}
	} else {
		header ("Location: index.php");
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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" href="css/index.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
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
				<li class="nav-item">
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
			<ul class="navbar-nav"><li class="nav-item">
					<a class="nav-link btn_" href="/autorization.php">Личный кабинет</a>
				</li>
			</ul>
		</div>
	</nav>
	
	
	
	<!--Сама форма входа-->
	<div class="container" style="text-align: center; margin-top: 20px">
		<form class="needs-validation" action="/reset.php" method="post" enctype="multipart/form-data" novalidate>
			<div class="form-row">
				<div class="col-md-12 mb-3">
					<label for="code">Введите код:</label>
					<input type="text" class="form-control" name="code" id="code" placeholder="6-значный код" required>
				</div>
			</div>
  			<button class="btn btn-primary" type="submit" name="reset">Подтвердить</button>
		</form>
	</div>
</div>
	
	
<script src="js/jquery.maskedinput.min.js"></script>
<script>
	$(function(){
	  	$("#code").mask("999999");
	});
</script>

	
	
	<!--Footer-->
	<footer class="footer">
		<div style="background-color: black">
      		<div class="container" style="padding: 20px 0px">
        		<span class="text-muted" id="spn">Все права защищены &copy 2019</span>
      		</div>
		</div>
    </footer>
	
	
</body>
</html>