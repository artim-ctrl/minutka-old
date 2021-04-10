<?php
	require('db.php');
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
	<div class="container" style="margin-top: 20px">
		<?php
			if (isset($_COOKIE['page'])) {//если была нажата одна из кнопок нумерации страниц
				$new_preview = R::findOne('news_preview', 'last = ?', array('1'));
				$last = $new_preview['id'] - ($_COOKIE['page'] - 1) * 10;
				unset ($_COOKIE['page']);
			} else {
				$new_preview = R::findOne('news_preview', 'last = ?', array('1'));
				$last = $new_preview['id'];
			}
			$i = $last;
			do {
				$new_preview = R::findOne('news_preview', 'id = ?', array($i));
				echo '<div class="card mb-3" style="max-width: 4000px; border-radius: 10px; background-color: #000; border: 1px solid #f47d32">
					<div class="row no-gutters">
						<div class="col-md-3">
							<img src="img/news/'.$new_preview['img'].'" style="border-radius: 10px" class="card-img" alt="">
						</div>
						<div class="col-md-9">
							<div class="card-body">
								<h5 class="card-title">'.$new_preview['name'].'</h5>
								<p class="card-text">'.$new_preview['text'].'</p>
							</div>
							<div class="card-footer">
								<div class="row">
									<div class="col-md-6">
										<p class="card-text"><small class="text-muted">'.$new_preview['time_reg'].'</small></p>
									</div>
									<div class="col-md-6">
										<div class="text-right">
											<button type="button" class="btn btn_info" onclick="more(\''.$new_preview['id'].'\')">Подробнее</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>';
				$i--;
			} while ($last - 10 < $i && $i > 0);
		?>
	</div>
</div>
	
	
	<!--Сама нумерация страниц-->
	<nav aria-label="page navigation">
		<div class="container" style="padding: 10px; width: 45px; margin: auto">
			<ul class="pagination">
				<li class="page-item page_link"><a class="page-link" onclick="switch_page('1')">1</a></li>
			</ul>
		</div>
	</nav>
	
	
	<script>//js для нумерации страниц
		function switch_page(num) {
			document.cookie = "page=" + num + "; path=/;";
			location.reload();
		}
		function more(id) {
			//добавление в куки id новости и переход на страницу more_about_new.php
			document.cookie = "new_id=" + id + "; path=/;";
			location.href = "more_about_new.php";
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