<?php

namespace App\Database;

final class MySQL
{
    private static null | \PDO $instancia = null;

    private function __construct(){}
    private function __clone(){}
    private function __makeup(){}

    public static function getInstancia():? \PDO
    {
        if (self::$instancia === null) {
            self::$instancia = new  \PDO('mysql:dbname=dc_financeiro;host=localhost','root','',array(
              
            ));
        }

        return self::$instancia;
    }
}