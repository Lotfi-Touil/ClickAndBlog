<?php

class Connexion
{
    protected static $bdd;

      private static $dns = 'mysql:host=;dbname=;charset=utf8';
      private static $user = '';
      private static $password  = '';

    public static function initConnexion()
    {
        try {
            self::$bdd = new PDO(self::$dns, self::$user, self::$password);
            self::$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $p) {
            echo $p->getCode() . $p->getMessage();
        }

    }
}
