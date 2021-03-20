<?php


namespace app\core\Database;

use app\core\Helpers\Helper;
use PDO;
use PDOException;

abstract class Core {
    final public static function connection(): PDO {
        try {
            $dbhost=Helper::env('DB_HOST');
            $dbname=Helper::env('DB_DATABASE');
            $dbport =Helper::env('DB_PORT');
            $dbusername=Helper::env('DB_USERNAME');
            $dbpassword=Helper::env('DB_PASSWORD');

            $db = new PDO("mysql:host={$dbhost};port={$dbport};dbname={$dbname}", $dbusername, $dbpassword);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $db;
        }
        catch (PDOException $e) {
            die("Connection failed: {$e->getMessage()}");
        }
    }
}