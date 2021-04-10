<?php
	require('db.php');

	$data = $_POST;
	if (isset($_SESSION['random_for_reset_email']) && isset($_SESSION['tmp_email']) && $_SESSION['input_code'] == 'yes') {
		if (isset($data['change_new_password'])) {
			if (trim($data['password']) == '') {
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите новый пароль!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			} else if (trim($data['password']) == trim($data['password_2'])) {
				$user = R::findOne('users', 'user_email = ?', array($_SESSION['tmp_email']));
				if (trim($data['phone']) == $user['user_phone']) {
					$user->user_password = password_hash($data['password'], PASSWORD_DEFAULT);
					R::store($user);
					unset ($_SESSION['random_for_reset_email']);
					unset ($_SESSION['tmp_email']);
					unset ($_SESSION['input_code']);
					header ("Location: autorization.php");
				} else {
					echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите номер телефона!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
				}
			} else {
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Пароли не совпадают!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
			}
		}
	} else if ($_SESSION['input_code'] == '') {
		unset ($_SESSION['random_for_reset_email']);
		unset ($_SESSION['tmp_email']);
		unset ($_SESSION['input_code']);
		header ("Location: autorization.php");
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
			<ul class="navbar-nav">
				<li class="nav-link">
					<?php if (isset ($_SESSION['logged_user'])) {echo "Здравствуйте, ".$_SESSION['logged_user']['user_name'];} ?>
				</li>
				<li class="nav-item">
					<a class="nav-link btn_" href="/personal.php">Личный кабинет</a>
				</li>
			</ul>
		</div>
	</nav>
	
	
	<!--Сама форма входа/регистрации-->
	<div class="container" style="text-align: center; margin-top: 20px">
	  		<form class="needs-validation" action="reset_.php" method="post" novalidate>
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<label for="password">Введите новый пароль</label>
						<input type="password" class="form-control" id="password" name="password" placeholder="Пароль" required>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<label for="password">Повторите новый пароль</label>
						<input type="password" class="form-control" id="password_2" name="password_2" placeholder="Пароль" required>
					</div>
				</div>
				<div class="form-row">
					<div class="col-md-12 mb-3">
						<label for="phone">Номер телефона</label>
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text" id="basic-addon1">+7</span>
							</div>
      						<input type="text" class="form-control" id="phone" name="phone" placeholder="Номер телефона" required>
						</div>
					</div>
				</div>
				<button class="btn btn-primary" type="submit" id="change_new_password" name="change_new_password">Сменить пароль</button>
			</form>
		</div>
	</div>
</div>
	
	
	<!--Footer-->
	<footer class="footer">
		<div style="background-color: black">
      		<div class="container" style="padding: 20px 0px">
        		<span class="text-muted" id="spn">Все права защищены &copy 2019</span>
      		</div>
		</div>
    </footer>
	
	<script src="js/jquery.maskedinput.min.js"></script>
	<script>
		$(function(){
			$("#phone").mask("(999) 999-99-99");
		});
	</script>
	
	
</body>
</html>