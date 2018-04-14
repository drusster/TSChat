<?php 
defined('peremen') or die();
// подключение модели
require_once MODEL;
// подключение библиотеки функций
require_once 'functions/functions.php';

//регистрация
if(isset($_POST['registration'])){
    registration();
}



// получение динамичной части шаблона .content
$view = empty($_GET['view']) ? 'enter' : $_GET['view'];

switch ($view) {
    case 'reg':
        $headeradd = " - регистрация";

        break;
    case 'logon':
        $headeradd = " - вход";

        break;
    default:
        break;
}


// подключени вида
require_once VIEW.'index.php';