<?php defined('peremen') or die();
class DB
{
    static $link_db;
    static $count = 0; 

    
    public static function connect()
    {// Синглтончик-с в целях экономии
        if(empty(self::$link_db))
        {
            self::$link_db = @mysqli_connect(HOST, USER, PASS,DB) 
                           or die('No connect'); 
            
            mysqli_set_charset(self::$link_db, 'utf8');
        }
    }
}

// Запускаем не отходя от кассы
DB::connect();

/* ===Регистрация=== */
function registration(){
    $error = ''; // флаг проверки пустых полей
    $login = strip_tags( trim(($_POST['login'])) );
    $pass = strip_tags( trim($_POST['pass']) );
       
    if(empty($login)) $error .= '<li>Не указан логин</li>';
    if(empty($pass)) $error .= '<li>Не указан пароль</li>';
    
   
    if(empty($error)){
        // если все поля заполнены
        // проверяем нет ли такого юзера в БД
        $query = "SELECT user_id FROM users WHERE login = '".clear($login)."' AND pass IS NOT NULL LIMIT 1";
        $res = mysqli_query(db::$link_db, $query) or die(mysqli_error(db::$link_db));
        $row = mysqli_num_rows($res); // 1 - такой юзер есть, 0 - нет
        if($row){
            // если такой логин уже есть
            $_SESSION['res'] = "<div class='error'>Этот логин уже зарегистрирован. Введите другой.</div>";
            redirect("?view=reg");
        }else{
            // если все ок - регистрируем
            $query = "INSERT INTO users (login, pass)
                        VALUES ('".clear($login)."', '".clear($pass)."')";
            $res = mysqli_query(db::$link_db, $query) or die(mysqli_error(db::$link_db));
            if($user_id = mysqli_insert_id(db::$link_db)){
                $_SESSION['res'] = "<div class='success'>Регистрация прошла успешно.</div>";
                // если запись добавлена
                $_SESSION['user_id'] = $user_id;
                $_SESSION['login'] = $login;
                redirect("?view=chat");
            }
            else{
                $_SESSION['res'] = "<div class='error'>Произошла внутренняя ошибка. Просим повторить регистрацию ещё раз.</div>";
            }
        }
    }else{
        // если не заполнены обязательные поля
        $_SESSION['res'] = "<div class='error'>Не заполнены обязательные поля: <ul> $error </ul></div>";
    }
}
/* ===Регистрация=== */

//авторизация 
function logon(){
    $error = ''; // флаг проверки пустых полей
    $login = clear(($_POST['login']));
    $pass = clear($_POST['pass']);
    if(empty($login)) $error .= '<li>Не указан логин</li>';
    if(empty($pass)) $error .= '<li>Не указан пароль</li>';
    
    if(empty($error)){
        // если получены данные из полей логин/пароль    
        $query = "SELECT user_id FROM users WHERE login = '$login' AND pass = '$pass' LIMIT 1";
        $res = mysqli_query(db::$link_db, $query) or die(mysqli_error(db::$link_db));
        if(mysqli_num_rows($res) == 1){
            // если авторизация успешна
            $row = mysqli_fetch_row($res);
            $_SESSION['user_id'] = $row[0];
            $_SESSION['login'] = $login;
            $_SESSION['res'] = "<div class='success'>Рады вас видеть.</div>";
            redirect("?view=chat");
        }
    }else{
        // если не заполнены обязательные поля
        $_SESSION['res'] = "<div class='error'>Не заполнены обязательные поля: <ul> $error </ul></div>";
    }

}

//записываю сообщение из чата
function message(){
    $query = "INSERT INTO messages (text, user_id)
                        VALUES ('".clear($_POST['message'])."', '".$_SESSION['user_id']."')";
    $res = mysqli_query(db::$link_db, $query) or die(mysqli_error(db::$link_db));
    if($user_id = mysqli_insert_id(db::$link_db)){
        
    }
    else{
        //$_SESSION['res'] = "<div class='error'>Произошла внутренняя ошибка. Просим повторить регистрацию ещё раз.</div>";
    }
}

//читаю записанные ранее сообщения
function read_messages($last_massage = FALSE){
    //объединяю результаты по колонке user_id внешней таблицы messages
    if(isset($last_massage) AND $last_massage != NULL) $last_massage = "WHERE m.message_id > '$last_massage' ";
    $query = "SELECT m.message_id,m.text, u.login 
                    FROM messages m 
                        LEFT JOIN users u ON m.user_id = u.user_id ".$last_massage."ORDER BY m.message_id DESC LIMIT 30";
    $res = mysqli_query(db::$link_db, $query) or die(mysqli_error(db::$link_db));
    while($row = mysqli_fetch_assoc($res)){
        $text[] = $row;
    }
    if(isset($last_massage) AND $last_massage AND mysqli_num_rows($res) > 0) { 
        foreach ($text as $value) {
            $class = ($value['login'] === $_SESSION['login'])? 'my': 'alien';
            $result .= "<div class='message ".$class."'><span>".$value['login']."</span>".$value['text']."</div>";
        }
        //print_arr($value);
        echo "<input type='hidden' name='last_messages' value=".$value['message_id']."/>".$result;
    }
    return (array)$text;
}