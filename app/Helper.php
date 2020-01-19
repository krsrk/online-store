<?php
namespace App;


class Helper
{
    public static function generateGuid($numberOfCharacters=8)
    {
        mt_srand((double) microtime() * 10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $guid = substr($charid, 0, $numberOfCharacters);

        return $guid;
    }
    public  static  function  generateFolio($numberOfCharacter=6){
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
       $folio = substr(str_shuffle($permitted_chars),0,6);
       return $folio;

    }
}
