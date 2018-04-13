<?php 
defined('peremen') or die();
// подключение модели
require_once MODEL;
// подключение библиотеки функций
require_once 'functions/functions.php';

// получение динамичной части шаблона .content
$view = empty($_GET['view']) ? 'enter' : $_GET['view'];




// подключени вида
require_once VIEW.'index.php';