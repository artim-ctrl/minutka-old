<?php
	require ('db.php');
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="yandex-verification" content="421280a517b3710a" />
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
	
	
	<!--Карусель-->
	<div>
		<div class="bd-example" style="padding: 25px 0px">
			<div id="carousel" class="carousel slide" data-ride="carousel">
				<!--<ol class="carousel-indicators">
					<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    			</ol>-->
    			<div class="carousel-inner">
      				<div class="carousel-item active" data-interval="500">
        			    <img src="img/-15procent.png" class="d-block w-100" alt="">
      				</div>
      				<div class="carousel-caption d-block">
          				<a class="carousel_link" onclick="new_click()">Подробнее</a>
        			</div>
    			</div>
    			<a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
      				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
      				<span class="sr-only">Previous</span>
    			</a>
    			<a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
      				<span class="carousel-control-next-icon" aria-hidden="true"></span>
      				<span class="sr-only">Next</span>
    			</a>
  			</div>
		</div>
	</div>
	
	
	<!--Карточки-->
	<div style="background-color: #000; padding-top: 40px;">
		<div class="container">
			<div class="card-deck">
				<div class="card mb-3 card_" href="#" style="max-width: 540px;">
					<div class="row no-gutters">
						<div class="col-md-2">
							<img src="img/автозапчасти.png" class="card-img" alt="">
						</div>
						<div class="col-md-10">
							<div class="card-body">
								<h5 class="card-title">Автозапчасти</h5>
								<p class="card-text">Широкая база проверенных поставщиков, быстрая доставка, отличное качество и защита клиента.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="card mb-3 card_" style="max-width: 540px;">
					<div class="row no-gutters">
						<div class="col-md-2">
							<img src="img/мойка.png" class="card-img" alt="">
						</div>
						<div class="col-md-10">
							<div class="card-body">
								<h5 class="card-title">Автомойка</h5>
								<p class="card-text">Высокая скорость и непревзойденное качество мойки Вашего автомобиля.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card-deck">
				<div class="card mb-3 card_" style="max-width: 540px;">
					<div class="row no-gutters">
						<div class="col-md-2">
							<img src="img/ремонт.png" class="card-img" alt="">
						</div>
						<div class="col-md-10">
							<div class="card-body">
								<h5 class="card-title">Ремонт</h5>
								<p class="card-text">Ремонт 99% марок автомобилей. Лучшие мастера с большим опытом работы, профессиональное оборудование для качественного ремонта Вашего автомобиля.</p>
							</div>
						</div>
					</div>
				</div>
				<!--<div class="card mb-3 card_" style="max-width: 540px;">
					<div class="row no-gutters">
						<div class="col-md-2">
							<img src="img/автоэл.png" class="card-img" alt="">
						</div>
						<div class="col-md-10">
							<div class="card-body">
								<h5 class="card-title">Диагностика/ Автоэлектрика</h5>
								<p class="card-text">Поиск и устранение самых сложных  неисправностей на любых авто.</p>
							</div>
						</div>
					</div>
				</div>-->
			</div>
		</div>
	</div>
	
	
	<!--О нас-->
	<div class="container">
		<div style="padding-top: 30px">
			<h1 style="text-align: center">
				О нас
			</h1>
		</div>
		<p style="text-align: justify; padding: 20px 60px;">Автосервис Минутка начал свое существование в далеком 2012 году под названием "СТО Братья". Все начиналось с обслуживания тогда еще маленьких фирм "Ваше такси" и "Такси престиж", обслуживанием которых мы занимаемся и сейчас. За это время не было НИ ОДНОГО ДТП по причине неисправности обслуживаемого у нас авто.
    Мы приобрели неоценимый  опыт ремонта, перепробовали сотни видов запчастей в такси, и смогли сделать выводы, каким производителям доверять, а каким не стоит.
    Мы открыли магазин и наладили работу с большим количеством поставщиков. Теперь весь этот опыт и знания служат одной цели: делать все чтобы Вы и Ваши автомобили были довольны.
    Ведь нам доверяют автомобили.</p>
	</div>
	
	
	<!--Контакты-->
	<div  style="background-color: #000; margin-bottom: 30px">
		<div class="container" style="text-align: center; padding: 40px 0px">
			<div class="row">
				<div class="col-md-6" style="text-align: right">
					<iframe src="https://www.google.com/maps/d/embed?mid=17SuQ-ynkCcA7p0zLciRdAglSCS0eFRRL" width="100%" height="450"></iframe>
				</div>
				<div class="col-md-6" style="text-align: left">
					<h4><big>Контакты:</big></h4>
					<p><big>E-mail: </big><a class="abtn" href="appeal.php"><big>derenko2@gmail.com</big></a></p>
					<p><big>Телефон: </big><a class="abtn" href="tel: 8 903 440 72 33"><big>8 903 440 72 33</big></a></p>
					<p><big>Адрес: г. Нефтекумск, ул. Ленина 2</big></p>
					<p><big>Время работы: 8:00-17:00 ежедневно</big></p>
					<p><big>Мы в социальных сетях:</big></p>
					<a href="https://vk.com/sto_minutka" target="_blank" class="btn link_ img-fluid rounded-circle"><i class="fab fa-vk" style="width: 45px; height: 45px" alt="" title="Мы в Вконтакте!"></i></a>
					<a href="https://www.youtube.com/user/derenko2" target="_blank" class="btn link_ img-fluid rounded-circle"><i class="fab fa-youtube" style="width: 45px; height: 45px" alt="" title="Мы в Вконтакте!"></i></a>
					<a href="https://www.instagram.com/minutka_neftekumsk/" target="_blank" class="btn link_ img-fluid rounded-circle"><i class="fab fa-instagram" style="width: 45px; height: 45px" alt="" title="Мы в Вконтакте!"></i></a>
				</div>
			</div>
		</div>
	</div>
</div>
	
	
	<!--Footer-->
	<footer class="footer" style="background-color: #000">
		<div>
      		<div class="container" style="padding: 20px 0px">
        		<span class="text-muted" id="spn">Все права защищены &copy 2019</span>
      		</div>
		</div>
    </footer>
	
	
	<script>
		var hammer = new Hammer(document.querySelector('.carousel'));
		var $carousel = $(".carousel").carousel({"interval":0});
		hammer.get("swipe");
		hammer.on("swipeleft", function(){
			$carousel.carousel("next");
		});
		hammer.on("swiperight", function(){
			$carousel.carousel("prev");
		});
	</script>
    
    
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
	
	
	<script>
	    function new_click () {
    	    /*$.post(
            "more_about_new.php",
                {
                    new_id: "1"
                }
            );*/
            document.cookie = "new_id=" + 2 + "; path=/;";
            location.href = "more_about_new.php";
	    }
	</script>
	
	
</body>
</html>