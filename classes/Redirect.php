<?php
class Redirect
{
    public static function to($location = null){
        if ($location){
            if (is_numeric($location)){
                switch ($location){
                    case 404:
                        header('');
                        include '';
                        exit;
                        break;
                }
            }
            header('Location' . $location);
        }
    }
}