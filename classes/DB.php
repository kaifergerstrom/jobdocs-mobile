<?php
namespace Classes;

use PDO;

class DB {

    private static function connect() {
        // Variables for PDO string
        $ip = "127.0.0.1";
        $dbname = "jobdocs";
        $username = "root";
        $password = "";

        // Create PDO connection to database
        $pdo = new PDO(sprintf('mysql:host=%s;dbname=%s;charset=utf8', $ip, $dbname), $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public static function query($query, $params = array()) {
      $statement = self::connect()->prepare($query);
      $statement->execute($params);
      
      if(explode(' ', $query)[0] == 'SELECT') {
        $data = $statement->fetchAll();
        return $data;
      }
    }

    public static function getDatetime() {
        date_default_timezone_set('US/Eastern');  // Set time to eastern time
        return date("Y-m-d h:i:sa");
    }

}

?>