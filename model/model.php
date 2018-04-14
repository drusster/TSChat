<?php
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
 

