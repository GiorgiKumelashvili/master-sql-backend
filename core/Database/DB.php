<?php

namespace app\core\Database;

final class DB extends Core {
    public static function InitializeConnection() {
        // Initialize Singleton and connect to database
        Core::Initialize();
    }

    public static function execute(string $query) {
        $connecton = parent::connection();
        return $connecton->query($query);
    }

    public static function RawQueryExecute(string $query, bool $returnData = true): ?array {
        $data = self::execute($query);

        if (!$returnData)
            return null;

        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function RetrieveColumns(string $query): array {
        $data = self::execute($query);

        return $data->fetchAll(\PDO::FETCH_COLUMN);
    }
}