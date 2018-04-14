<?php
defined('peremen') or die();

// домен
define('PATH', '//tschat/');

// модель
define('MODEL', 'model/model.php');

// контроллер
define('CONTROLLER', 'controller/controller.php');

// вид
define('VIEW', 'view/');

//активный шаблон
define('TEMPLATE', PATH.VIEW);

//необходимо для подключения к БД
// сервер БД
define('HOST', 'localhost');

// пользователь
define('USER', 'root');

// пароль
define('PASS', '');

// БД
define('DB', 'tschat');

if (session_status() == PHP_SESSION_NONE) {//проверка не включена ли сессия
    session_start();
}