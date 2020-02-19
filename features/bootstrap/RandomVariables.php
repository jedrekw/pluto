<?php

class RandomVariables
{

    public static $data = array();
    
    public static function generateRandomString($length)
    {
        if ($length == null) {
            $length = 8;
        }
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $string = '';
        while ($length--) {
            $string .= $characters[mt_rand(0, $charactersLength-1)];
        }
        return $string;
    }
    
    public static function generateRandomNumber($min, $max)
    { 
        return rand($min, $max);
    }
    
    public static function attachRandomStringToArray($name, $length, $parts)
    {
        if ($length == null) {
            $length = 8;
        }
        if ($name == null) {
            $name = 'random';
        }
        if ($parts == null) {
            $parts = 1;
        }
        $part1 = RandomVariables::generateRandomString($length);
        $part2 = RandomVariables::generateRandomString($length);
        if ($parts==1) {
            $string = $part1;
            }
        if ($parts==2) {
            $string = $part1." ".$part2;
        }
        RandomVariables::$data[$name] = $string;
        return RandomVariables::$data[$name];

    }
    
    public static function attachRandomNumberToArray($name, $min, $max)
    {
        if ($min == null) {
            $min = 0;
        }
        if ($max == null) {
            $max = 100;
        }
        if ($name == null) {
            $name = 'random';
        }
        $string = RandomVariables::generateRandomNumber($min, $max);

        return RandomVariables::$data[$name] = $string;
    }
    
    public static function getString($name)
    {
//         var_export("1");
        if ($name == null) {
            $name = 'random';
        }
//         var_export("2");
        if (array_key_exists($name, self::$data) === false){
            return null;
        }
//         var_export(array_keys(RandomVariables::$data));
//         var_export(array_values(RandomVariables::$data));
//         var_export("passed arg".$name);
//         var_export("string w ".RandomVariables::$data[$name]);
        return RandomVariables::$data[$name];
    }
    
    public static function attachRandomEmailToArray($name)
    {
        if ($name == null) {
            $name = 'email';
        }
        $emailValue = RandomVariables::generateRandomString(RandomVariables::generateRandomNumber(7, 12))."@gmail.com";
        RandomVariables::$data[$name] = $emailValue;
        return RandomVariables::$data[$name];  
    }
}