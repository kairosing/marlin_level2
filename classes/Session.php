<?php

class Session
{
    public static function put($name, $value){ // запись в сессию
        return $_SESSION[$name] = $value;
    }

    public static function exists($name){ // проверка существует ли такое значение в сессии
        return (isset($_SESSION[$name])) ? true : false;
    }

    public static function delete($name){ // удоление сессии
        if (self::exists($name)){
            unset($_SESSION[$name]);
        }
    }

    public static function get($name){ // получение сессии
        return $_SESSION[$name];
    }

    public static function flash($name, $string = ''){
        if (self::exists($name) && self::get($name) !== ''){
            $session = self::get($name);
            self::delete($name);
            return $session;
        }else {
            self::put($name, $string);
        }
    }

    public static function flashExists($name){
        return self::exists($name) && self::get($name) != '';
    }
}