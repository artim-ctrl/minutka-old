<?php
	require("db.php");

	$data = $_POST;

	if (isset($_SESSION['logged_user'])) {
		//если клиент совершал вход
		$errors = array();
		$user = R::findOne('users', 'user_email = ?', array($_SESSION['logged_user']['user_email']));//находим учетку в бд
		if (isset($data['save_data'])) {
			if ($data['name'] != '') {//имя
				$user->user_name = $data['name'];
			}
			if ($data['vin'] != '') {//вин-код
				$user->user_vin = $data['vin'];
			}
			if ($data['password_2'] != '') {
			    if ($data['password'] != '') {
        			if (password_verify($data['password'], $user->user_password)) {//пароль
        				//если старый пароль верен
        				$user->user_password = password_hash($data['password_2'], PASSWORD_DEFAULT);
        			} else if ($data['password'] != '') {
        				$errors[] = 'Введите верный старый пароль!';
        			}
			    } else {
			        $errors[] = 'Введите старый пароль!';
			    }
			}
			if ($data['phone'] != '') {//телефон
				$user->user_phone = $data['phone'];
			}
			if ($data['email'] != '' && filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {//email
				$user->user_email = $data['email'];
			} else if ($data['email'] != '' && !(filter_var($data['email'], FILTER_VALIDATE_EMAIL))) {
				$errors[] = 'Введите E-mail верно!';
			}
			if (isset($_FILES['ava_img']) && $_FILES['ava_img']['name'] != '' && $_FILES['ava_img']['name'] != $user['user_avatar_image']) {//фото
				if (@copy($_FILES['ava_img']['tmp_name'], 'img/'.$_FILES['ava_img']['name'])) {
					if ($user['user_avatar_image'] != '') {
						unlink ('img/'.$user['user_avatar_image']);
					}
					$user->user_avatar_image = $_FILES['ava_img']["name"];
					echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Загружено!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";//Успешно
				} else {
					$errors[] = 'Не удалось загрузить изображение';
				}
			}
			R::store ($user);
			$_SESSION['logged_user'] = $user;
			
			if (!empty($errors)) {
				echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>".array_shift($errors)."<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
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

    <!-- Bootstrap 4 -->
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
					<a class="nav-link btn_" href="/log_out.php">Выйти</a>
				</li>
			</ul>
		</div>
	</nav>
	
	
	<!--Инфа личного кабинета-->
	<div class="container" style="text-align: center">
		<div class="card mb-3" style="max-width: 4000px; background-color: #000; border-radius: 10px; margin-top: 20px">
  			<div class="row no-gutters">
    			<div class="col-md-4">
      				<img src="<?php if (isset($user['user_avatar_image'])) {echo 'img/'.$user['user_avatar_image'].'';} else {echo 'img/default_avatar.jpg';} ?>" class="card-img" style="border-radius: 10px; margin: 5px; border: 1px solid #ccc" alt="">
    			</div>
    			<div class="col-md-8">
      				<div class="card-body">
        				<form class="needs-validation" enctype="multipart/form-data" action="/personal.php" method="post" id="form_reg" novalidate>
  							<div class="form-row">
								<div class="col-md-6 mb-3">
									<label for="name"><?php echo "<div>".$user['user_name']."</div>" ?></label>
									<input type="text" class="form-control" id="name" name="name" placeholder="Имя" required>
								</div>
								<div class="col-md-6 mb-3">
									<label for="vin"><?php if (isset($user['user_vin'])) {echo "".$user['user_vin']."";} else {echo "VIN-код автомобиля";} ?></label>
									<input type="text" class="form-control" id="vin" name="vin" placeholder="VIN-код" required>
								</div>
							</div>
							<div class="form-row">
								<div class="col-md-6 mb-3">
      								<label for="password">Старый пароль</label>
      								<input type="password" class="form-control" id="password" name="password" placeholder="Пароль" required>
    							</div>
								<div class="col-md-6 mb-3">
      								<label for="password_2">Новый пароль</label>
      								<input type="password" class="form-control" id="password_2" name="password_2" placeholder="Пароль" required>
    							</div>
								<div class="col-md-6 mb-3">
      								<label for="phone"><?php echo "<div>".$user['user_phone']."</div>" ?></label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text" id="basic-addon1">+7</span>
										</div>
      									<input type="text" class="form-control" id="phone" name="phone" placeholder="Номер телефона" required>
									</div>
    							</div>
    							<div class="col-md-6 mb-3">
      								<label for="email"><?php echo "<div>".$user['user_email']."</div>" ?></label>
      								<input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
    							</div>
  							</div>
							<div class="form-row">
								<div class="col-md-12 mb-3">
									<div class="form-group">
										<div class="custom-file">
  											<input type="file" class="custom-file-input" id="ava_img" name="ava_img" accept="image/jpeg,image/png,image/gif">
  											<label class="custom-file-label" for="ava_img">Загрузите фотографию</label>
										</div>
  									</div>
								</div>
							</div>
  							<button class="btn btn_info" type="submit" id="save_data" name="save_data">Сохранить новые данные</button>
						</form>
      				</div>
    			</div>
  			</div>
		</div>
	</div>
</div>


<script src="js/jquery.maskedinput.min.js"></script>
<script>
    $("img").mousedown(function(e){
        e.preventDefault()
    });
	$(function(){
	  	$("#phone").mask("(999) 999-99-99");
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
	
	
		
	</script>
</body>
</html>