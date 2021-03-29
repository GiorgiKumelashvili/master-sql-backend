<?php

/**
 * @noinspection SqlNoDataSourceInspection,SqlResolve
 */

namespace app\api\controllers;


use app\core\Database\DB;
use app\core\Http\Http;

class DefaultTableController {
    private string $MOVIES = 'movies';
    private string $TICKETS = 'tickets';
    private string $USERS = 'users';

    private function createTables(): void {
        DB::RawQueryExecute("
            CREATE TABLE IF NOT EXISTS {$this->MOVIES} (
                id INT AUTO_INCREMENT NOT NULL,
                name VARCHAR(50) NOT NULL,
                genre VARCHAR(255) NOT NULL,
                duration DECIMAL(5,2) NOT NULL,
                review DECIMAL(2,1) NOT NULL,
                age_restriction INT NOT NULL,
                PRIMARY KEY (id)
            );
        ");

        DB::RawQueryExecute("
            CREATE TABLE IF NOT EXISTS {$this->TICKETS} (
                id INT AUTO_INCREMENT NOT NULL,
                movie_id INT NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (movie_id) REFERENCES {$this->MOVIES}(id)
            );
        ");

        DB::RawQueryExecute(" 
            CREATE TABLE IF NOT EXISTS {$this->USERS} (
                id INT AUTO_INCREMENT NOT NULL,
                name VARCHAR(50) NOT NULL,
                age INT NOT NULL ,
                balance INT NOT NULL,
                gender VARCHAR(10) NOT NULL,
                ticket_id INT NOT NULL,
                PRIMARY KEY (id),
                FOREIGN KEY (ticket_id) REFERENCES {$this->TICKETS}(id)
            );
        ");
    }

    private function insertDataIntoTables(): void {
        DB::RawQueryExecute("
            insert into {$this->MOVIES} (id, name, duration, review, age_restriction, genre) values (1, 'Much Ado About Something', 2.28, 3.4, 18, 'Documentary');
            insert into {$this->MOVIES} (id, name, duration, review, age_restriction, genre) values (2, 'Dungeons & Dragons', 2.34, 2.6, 20, 'Adventure|Fantasy');
            insert into {$this->MOVIES} (id, name, duration, review, age_restriction, genre) values (3, 'Shadow of the Thin Man', 2.1, 2.0, 18, 'Comedy|Crime|Mystery');
            insert into {$this->MOVIES} (id, name, duration, review, age_restriction, genre) values (4, 'Canadian Bacon', 1.46, 0.2, 19, 'Comedy|War');
            insert into {$this->MOVIES} (id, name, duration, review, age_restriction, genre) values (5, 'Stanley Kubrick: A Life in Pictures', 2.28, 4.5, 18, 'Documentary');
            
            
            insert into {$this->TICKETS} (id, movie_id) values (1 , 4);
            insert into {$this->TICKETS} (id, movie_id) values (2 , 3);
            insert into {$this->TICKETS} (id, movie_id) values (3 , 2);
            insert into {$this->TICKETS} (id, movie_id) values (4 , 1);
            insert into {$this->TICKETS} (id, movie_id) values (5 , 5);
            
            
            insert into {$this->USERS} (id, name, age, balance, gender, ticket_id) values (1, 'Glynn', 23, 459, 'Male', 1);
            insert into {$this->USERS} (id, name, age, balance, gender, ticket_id) values (2, 'Gonzalo', 14, 552, 'Male', 2);
            insert into {$this->USERS} (id, name, age, balance, gender, ticket_id) values (3, 'Laure', 30, 198, 'Male', 3);
            insert into {$this->USERS} (id, name, age, balance, gender, ticket_id) values (4, 'Aloin', 12, 168, 'Female', 4);
            insert into {$this->USERS} (id, name, age, balance, gender, ticket_id) values (6, 'Michail', 21, 551, 'Female', 5);
        ");
    }

    private function deleteTables(): void {
        DB::RawQueryExecute("SET foreign_key_checks = 0");
        DB::RawQueryExecute("DROP TABLE IF EXISTS {$this->MOVIES},{$this->TICKETS},{$this->USERS};");
        DB::RawQueryExecute("SET foreign_key_checks = 1");
    }

    public function resetData(): void {
        $this->deleteTables();
        $this->createTables();
        $this->insertDataIntoTables();

        Http::$app->response()->json([
            "message" => "reseted data"
        ]);
    }
}

