<?php
    require ('db.php');

    $data = $_POST;

    if (isset($data['send'])) {
        if (trim($data['review_text']) != "") {
            $review = R::findOne('reviews', 'last = ?', array('1'));//сменить
            $user = R::findOne('users', 'user_email = ?', array($_SESSION['logged_user']['user_email']));
            if (R::count('reviews', "last = ?", array('1')) > 0) {
                $review->last = '0';
                R::store($review);
            }
            $review = R::dispense('reviews');//сменить
            $review->user_id = $user['id'];
            $review->review_text = $data['review_text'];
            $review->last = '1';
            $review->time = date("F j, Y, H:i:s");
            R::store($review);
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите комментарий!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
    } else if (isset($data['edit'])) {
        if (trim($data['edited_review']) != '' && trim($data['id_']) != '') {
            //добавить проверку на время, (изменено)
            $review = R::findOne('reviews', 'id = ?', array($data['id_']));
            $review->review_text = $data['edited_review'];
            R::store($review);
        } else if (trim($data['id_']) == '') {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите id комментария!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите комментарий!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
    } else if (isset($data['reply'])) {
        if (trim($data['reply_review']) != '' && trim($data['id_']) != '') {
            //добавить проверку на время, (изменено)
            $review = R::findOne('reviews', 'id = ?', array($data['id_']));
            $review->answer_admin = $data['reply_review'];
            R::store($review);
        } else if (trim($data['id_']) == '') {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите id комментария!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите ответ на комментарий!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
    } else if (isset($data['edit_answer'])) {
        if (trim($data['edited_answer_review']) != '' && trim($data['id_']) != '') {
            //добавить проверку на время, (изменено)
            $review = R::findOne('reviews', 'id = ?', array($data['id_']));
            $review->answer_admin = $data['edited_answer_review'];
            R::store($review);
        } else if (trim($data['id_']) == '') {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите id комментария!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Введите измененный ответ на комментарий!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
        }
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


    <!-- edit_modal -->
    <div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #000; border: 1px solid #fff">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Изменение комментария</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #ccc">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="/reviews.php" method="post" novalidate>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ID комментария:</label>
                        <input type="text" class="form-control" name="id_"></input>
                        <label for="message-text" class="col-form-label">Текст комментария:</label>
                        <textarea class="form-control" id="message-text" name="edited_review"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit" class="btn btn_info">Изменить</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!-- reply_modal -->
    <div class="modal fade" id="reply_modal" tabindex="-1" role="dialog" aria-labelledby="reply_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #000; border: 1px solid #fff">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ответить на комментарий</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #ccc">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="/reviews.php" method="post" novalidate>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ID комментария:</label>
                        <input type="text" class="form-control" name="id_"></input>
                        <label for="message-text" class="col-form-label">Текст ответа на комментарий:</label>
                        <textarea class="form-control" id="message-text" name="reply_review"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="reply" class="btn btn_info">Ответить</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
    
    <!-- edit_answer_modal -->
    <div class="modal fade" id="edit_answer_modal" tabindex="-1" role="dialog" aria-labelledby="edit_answer_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #000; border: 1px solid #fff">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Изменение комментария</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: #ccc">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="/reviews.php" method="post" novalidate>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">ID комментария:</label>
                        <input type="text" class="form-control" name="id_"></input>
                        <label for="message-text" class="col-form-label">Текст комментария:</label>
                        <textarea class="form-control" id="message-text" name="edited_answer_review"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="edit_answer" class="btn btn_info">Изменить</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <div style="background-color: #000; margin-top: 30px; margin-bottom: 30px; padding-bottom: 15px">
        <div class="container" style="padding-top: 20px; padding-bottom: 10px">

                <?php
                    if (isset($_SESSION['logged_user'])) {
                        //Добавляем форму добавления комментария
                        echo '<div style="border-bottom: 1px solid #ccc"><div class="container" style="padding: 30px 20px; margin-bottom: 20px; border-radius: 10px; border: 1px solid #ccc">
                            <form class="needs-validation" action="/reviews.php" method="post" enctype="multipart/form-data" novalidate>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <label for="review_text">Ваш комментарий:';
                                            /*echo '<div>';
                                                echo '<button onclick=""><i class="fas fa-star star_"></i></button>';
                                                echo '<button><i class="fas fa-star star_"></i></button>';
                                                echo '<button><i class="fas fa-star star_"></i></button>';
                                                echo '<button><i class="fas fa-star star_"></i></button>';
                                                echo '<button><i class="fas fa-star star_"></i></button>';
                                            echo '</div>';*/
                                        echo '</label>
                                        <textarea class="form-control form_" name="review_text" id="review_text" placeholder="Текст комментария" style="height: 80px; max-height: 80px" required></textarea>
                                    </div>
                                </div>
                                <button class="btn btn_info" type="submit" name="send">Отправить</button>
                            </form>
                        </div></div>';
                    } else {
                        echo '<div style="color: #f47d32;font-size: 1.5em; text-align: center; margin: 20px 0px; padding-bottom: 20px; border-bottom: 1px solid #ccc">Зарегистрируйтесь, чтобы оставить комментарий</div>';
                    }
                ?>

                <?php
                    if (isset($_COOKIE['page'])) {//если была нажата одна из кнопок нумерации страниц
                        $review = R::findOne('reviews', 'last = ?', array('1'));//сменить
                        $last = $review['id'] - ($_COOKIE['page'] - 1) * 10;
                        unset ($_COOKIE['page']);
                    } else {
                        $review = R::findOne('reviews', 'last = ?', array('1'));
                        $last = $review['id'];
                    }
                    $i = $last;
                    if ($i != 0) { 
                        do {
                            $review = R::findOne('reviews', 'id = ?', array($i));
                            $user = R::findOne('users', 'id = ?', array($review['user_id']));
                            echo '<div class="media" style="padding: 5px; margin-top: 20px; border-radius: 10px; border: 1px solid #ccc">';
                            echo '<img src="img/';
                            if (isset($user['user_avatar_image'])) {echo $user['user_avatar_image'];} else {echo 'default_avatar.jpg';}
                            echo '" class="mr-3" style="border-radius: 2px; margin: 5px; width: 64px; height: 64px; border: 1px solid #ccc" alt="">
                                <div class="media-body">
                                    <h5 class="mt-0">'.$user["user_name"];

                                        /*echo '<div>';
                                        echo '<i class="fas fa-star"';
                                        if ($review['quantity_stars'] >= 1) echo 'style="color: #f47d32"';
                                        echo '></i>';
                                        echo '<i class="fas fa-star"';
                                        if ($review['quantity_stars'] >= 2) echo 'style="color: #f47d32"';
                                        echo '></i>';
                                        echo '<i class="fas fa-star"';
                                        if ($review['quantity_stars'] >= 3) echo 'style="color: #f47d32"';
                                        echo '></i>';
                                        echo '<i class="fas fa-star"';
                                        if ($review['quantity_stars'] >= 4) echo 'style="color: #f47d32"';
                                        echo '></i>';
                                        echo '<i class="fas fa-star"';
                                        if ($review['quantity_stars'] == 5) echo 'style="color: #f47d32"';
                                        echo '></i>';
                                        echo '</div>';*/
                                        echo'<span class="text-muted" name="time_" style="font-size: 0.6em; margin: 0px 7px">'.$review['time'].'</span>';
                                        if ($_SESSION['logged_user']['id'] == 1) {
                                            echo '<a class="a_" data-toggle="modal" data-target="#edit_modal">';
                                            echo '<i class="fas fa-edit"></i>';
                                            echo '</a>';
                                            echo '<a class="a_" data-toggle="modal" data-target="#reply_modal">';
                                            echo '<i class="fas fa-reply"></i>';
                                            echo '</a>';
                                            echo $i;
                                        }

                                    echo '</h5>';
                                    echo $review["review_text"];

                                    if (isset($review['answer_admin']) && $review['answer_admin'] != ""){
                                        $admin = R::findOne('users', 'id = ?', array('1'));//сменить
                                        echo '<div class="media mt-3">
                                            <img src="img/'.$admin['user_avatar_image'].'" style="border-radius: 2px; margin: 5px; width: 64px; height: 64px; border: 1px solid #ccc" class="mr-3" alt="">
                                            <div class="media-body">
                                                <h5 class="mt-0">'.$admin['user_name'];
                                                if ($_SESSION['logged_user']['id'] == 1) {
                                                    echo '<a class="a_" data-toggle="modal" data-target="#edit_answer_modal"><i class="fas fa-edit"></i></a>';
                                                }
                                                echo '</h5>
                                                '.$review['answer_admin'].'
                                            </div>
                                        </div>';
                                    }
                                echo '</div>';
                                echo '</div>';
                            $i--;
                        } while ($last - 10 < $i && $i > 0);
                    } else {
                        echo '<div style="color: #f47d32; font-size: 1.5em; text-align: center; margin: 20px 0px">Комментариев нет, оставьте первый</div>';
                    }
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
        </script>
	
	
</div>
	
	
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