<?php

require ("libs/rb.php");

R::setup( 'mysql:host=localhost;dbname=derenko2_db',
        'derenko2_db', 'vzVWWfCb' );//подключение к бд, поменять данные при заливе на хостинг
session_start();