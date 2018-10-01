<?php

/**
 * Created by PhpStorm.
 * User: kobus
 * Date: 12/6/2016
 * Time: 9:07 AM
 */

class Database
{
    private static $instance = null;

    public $pdo;

    private function __construct() {
        $this->pdo = new PDO("mysql:host=localhost;dbname=vlambeer", "root", "");

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public static function getInstance() {
       if ( is_null(self::$instance)) {
           self::$instance = new Database();
       }

      return self::$instance;
    }
}