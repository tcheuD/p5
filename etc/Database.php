<?php

namespace Core;

class Database
{
    public static function dbConnect()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        $config = require __DIR__.'./../config/pdo.php';
        try {
            return new \PDO($config['driver'].':host='.$config["host"].';dbname='.$config['dbname'].';charset=utf8',
                $config['username'], $config['password']);
        } catch (\Exception $e) {
           // die('Erreur : ' . $e->getMessage());
        }
    }
}
