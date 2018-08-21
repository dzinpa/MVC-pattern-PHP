<?php
/**
 * Return object of class PDO
 * @params array from db_params.php
 * 
 */
class DB 
{
    public static function getConnection()
    {
        $paramsPath = ROOT . '/config/db_params.php';
        $params = include ($paramsPath);//get array from db_params
        //Create object PDO class
        $dsn = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsn, $params['user'], $params['password']);
        
        return $db;
    }
   
    
}
