<?php

namespace App\Smark\DB;

class DB
{
    public static function connect($host, $username, $password, $database)
    {
        return mysqli_connect($host, $username, $password, $database);
    }
}
