<?php

class ConexionAdmin
{
    static public function conectar()
    {
        $link = new PDO("mysql:host=localhost;dbname=repuestoscris", "root", "");
        $link->exec("set names utf8");
        return $link;
    }
}
