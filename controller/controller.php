<?php 
defined('peremen') or die();
// подключение модели
require_once MODEL;
// подключение библиотеки функций
require_once 'functions/functions.php';

// выход пользователя
if(isset($_GET['do']) AND $_GET['do'] === 'logout'){
    logout();
    redirect('/');
}
//регистрация
if(isset($_POST['registration'])){
    registration();
}elseif(isset($_POST['login'])  AND isset($_POST['pass'])){ //авторизация
    logon();
    if(!$_SESSION['user_id']){ 
        // если авторизация неудачна
        $_SESSION['res'] = "<div class='error'>Вы ввели неправильно логин/пароль.</div>";
    }
    redirect();
}

//сообщение от юзера
if(isset($_POST['message']) AND $_POST['message']){
    message();
    redirect();
}

// получение динамичной части шаблона 
if(isset($_SESSION['user_id']) AND isset($_SESSION['login'])) {
    $view = 'chat';
}
else $view = empty($_GET['view']) ? 'enter' : $_GET['view'];

switch ($view) {
    case 'reg':
        $headeradd = " - регистрация";

        break;
    case 'logon':
        $headeradd = " - вход";

        break;
    case 'chat':
        $headeradd = " - [".$_SESSION['login']."]";
        $messages = read_messages();
        print_arr($messages);
        break;
    default:
        break;
}


// подключени вида
require_once VIEW.'index.php';