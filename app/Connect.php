<?php

namespace App;

class Connect 
{
    static function getPDO($db_name, $db_login, $db_password) 
    {   
        $pdo = new \PDO('mysql:host=localhost;dbname=' . $db_name . ';charset=utf8', $db_login, $db_password, array(
            \PDO::ATTR_PERSISTENT => true
        ));
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }   
}
