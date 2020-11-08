<?php

namespace App\Libraries;

class Helpers{
    public static function generateRandomString($length = 15) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function excelDate($ed){
        $miliseconds = ((int)$ed - (25567 + 2)) * 86400 * 1000;
        $seconds = $miliseconds / 1000;
        return date("Y-m-d", $seconds); 
    }
    
}


    