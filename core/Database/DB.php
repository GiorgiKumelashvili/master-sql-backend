<?php

namespace app\core\Database;

final class DB extends Core {
    public static function InitializeConnection() {
        // Initialize Singleton and connect to database
        Core::Initialize();
    }

    public static function RawQueryExecute(string $rawquery):void {
        $connecton = parent::connection();
        $connecton->exec($rawquery);
    }
}