<?php
	require('db.php');
	
    $new_preview = R::findOne('news_preview', 'id = ?', array($_COOKIE['new_id']));
    unset ($_COOKIE['new_id']);

	$last = R::findOne('news_preview', 'last = ?', array('1'));
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
				<li class="nav-item active">
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
	
	<!--Список новостей-->
	<div class="container" style="border: 1px solid #f47d32; background-color: #000; border-radius: 10px; padding: 20px; margin-top: 20px; margin-bottom: 20px">
		<img src="<?php echo 'img/news/'.$new_preview['img'].'' ?>" align="left" style="width: 350px; max-height: 350px; margin-bottom: 10px; margin-right: 30px; border-radius: 10px">
    	<h4 style="text-align: center"><?php echo ''.$new_preview['name'].'' ?></h4>
    	<p class="text-muted" style="font-size: 0.93rem; text-align: justify"><?php echo $new_preview['text'] ?></p>
		<div style="margin-top: 20px"><p><?php echo $new_preview['full_text'] ?></p></div>
		<div class="row" style="margin-top: 10px">
			<div class="col-md-1"></div>
			<div class="col-md-5" style="text-align: left">
				<?php
					if ($new_preview['id'] != 1) {
						echo '<button type="button" class="btn btn-outline-info" onclick="prev_new('.$new_preview['id'].')">&#8592; Предыдущая запись</button>';
					}
				?>
			</div>
			<div class="col-md-5" style="text-align: right">
				<?php
					if ($new_preview['id'] != $last['id']) {
						echo'<button type="button" class="btn btn-outline-info" onclick="next_new('.$new_preview['id'].')">Следующая запись &#8594;</button>';
					}
				?>
			</div>
		</div>
	</div>
</div>
	
	
	<script>
		function next_new (id) {
			document.cookie = "new_id=" + (id + 1) + "; path=/;";
			location.reload();
		}
		function prev_new (id) {
			document.cookie = "new_id=" + (id - 1) + "; path=/;";
			location.reload();
		}
	</script>
	
	
	<!--Footer-->
	<footer class="footer">
		<div style="background-color: black">
      		<div class="container" style="padding: 20px 0px">
        		<span class="text-muted" id="spn">Все права защищены &copy 2019</span>
      		</div>
		</div>
    </footer>
    
    
    <!-- easing plugin ( optional ) -->
	<script src="/js/easing.js" type="text/javascript"></script>
	<!-- UItoTop plugin -->
	<script src="/js/jquery.ui.totop.js" type="text/javascript"></script>
	<!-- Starting the plugin -->
	<script type="text/javascript">
	    $("img").mousedown(function(e){
            e.preventDefault()
        });
		$(document).ready(function() {
			/*
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear'
			};
			*/

			$().UItoTop({ easingType: 'easeOutQuart' });

		});
	</script>
	
	
</body>
</html>