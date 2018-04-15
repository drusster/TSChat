<?php
defined('peremen') or die();
//фильтр входящих данных
function clear($var){
    $var = mysqli_real_escape_string(db::$link_db, strip_tags(trim($var)));
    $var = mb_substr($var, 0, 1000, 'UTF-8');
    return $var;
}

function redirect($http=FALSE){
    
    if($redirect === null AND $http === FALSE) {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
        //print_arr($_SERVER);echo "asdfasdf";//$_SERVER['HTTP_REFERER'];
    }else{
        $redirect = $http;
    }
    header("Location: $redirect");
    exit;
}

/* ===Выход пользователя=== */
function logout(){
    unset($_SESSION['user_id'], $_SESSION['login']);
}
/* ===Выход пользователя=== */

