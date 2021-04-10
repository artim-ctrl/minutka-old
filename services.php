<?php
	require('db.php');
	

	//Had to change this path to point to IOFactory.php.
	//Do not change the contents of the PHPExcel-1.8 folder at all.
	include('PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

	
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
			background: url("img/background.png") center no-repeat fixed;
			-webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
		}
	</style>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/carparts.css">
	<link rel="stylesheet" href="css/services.css">
	<link rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
	<link rel="stylesheet" href="css/ui.totop.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
	<script src="/js/jquery.mCustomScrollbar.concat.min.js"></script>
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
					<a class="nav-link btn_" href="/autorization.php">Личный кабинет</a>
				</li>
			</ul>
		</div>
	</nav>
	
	
	<div class="container" style="margin-top: 5%; font-size: 1.3em; text-align: center; margin-bottom: 30px">

		<h3>Услуги оказываемые нашим автосервисом:</h3><br />
		<div class="table-scroll" style="max-width: 100%">
			<?php
				//Use whatever path to an Excel file you need.

				// Открываем файл
				$xls = PHPExcel_IOFactory::load('Prays_list_minutka_2.xlsx');
				// Устанавливаем индекс активного листа
				$xls->setActiveSheetIndex(0);
				// Получаем активный лист
				$sheet = $xls->getActiveSheet();

				echo "<table style='background-color: #000'>";
	
				for ($i = 1; $i <= $sheet->getHighestRow(); $i++) { 
					$v_1 = $sheet->getCellByColumnAndRow(0, $i)->getValue();
					if (trim($v_1) != '') { 
						echo "<tr>";
						
						$nColumn = PHPExcel_Cell::columnIndexFromString(
							$sheet->getHighestColumn());
						$nColumn--;
						
						for ($j = 0; $j < $nColumn; $j++) {
							$value = $sheet->getCellByColumnAndRow($j, $i)->getValue();
							$v_2 = $sheet->getCellByColumnAndRow(6, $i)->getValue();
							if (trim($v_2) == '3') {
								//главный заголовок
								echo "<th class='elem_table th_table'>$value</th>";
							} else if (trim($v_2) == '2') {
								//2-ой заголовок
								echo "<th class='elem_table th_2_table'>$value</th>";
							} else if (trim($v_2) == '1') {
								//3-ий заголовок
								echo "<th class='elem_table th_3_table'>$value</th>";
							} else {
								//обычная строка
								echo "<td class='elem_table'>$value</td>";
							}
						}
						echo "</tr>";
					}
				}
				echo "</table>";
			?>
		</div>

		<div style="background-color: #000; border-radius: 10px; padding: 10px; margin-top: 20px; border: 1px solid #f47d32">
			<h4 style="text-align: left; border-bottom: 1px solid #ccc; padding-bottom: 15px">Стоимость ремонта может меняться в любую сторону в  зависимости от сложности работы по конкретному автомобилю, наличия поврежденных резьб, ржавчины и тд.</h4>
			<p style="text-align: left; border-bottom: 1px solid #ccc; padding-bottom: 15px">(1) Тросовый механизм управления кпп.</p>
			<p style="text-align: left; border-bottom: 1px solid #ccc; padding-bottom: 15px">(2) Дисковый тормоз.</p>
			<p style="text-align: left">(3) Зависит от стороны установки.</p>
		</div>

	</div>
	
	
</div>


	<script>
		(function($){
			$(window).on("load",function(){
				$(".table-scroll").mCustomScrollbar();
			});
		})(jQuery);
		$(".table-scroll").mCustomScrollbar({
    		axis:"x" // horizontal scrollbar
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