<?php
/**
 * @noinspection SqlResolve, SqlNoDataSourceInspection
 */

namespace app\api\controllers;


use app\core\Database\DB;
use app\core\Http\Http;

class TableController {
    private string $moviesDB = 'movies';
    private string $ticketsDB = 'tickets';
    private string $usersDB = 'users';
    /**
     * The main data function
     */
    public function index() {
        $movies = DB::RawQueryExecute("SELECT * FROM {$this->moviesDB}");
        $tickets = DB::RawQueryExecute("SELECT * FROM {$this->ticketsDB}");
        $users = DB::RawQueryExecute("SELECT * FROM {$this->usersDB}");

        Http::$app->response()->json([
            'movies' =>  $movies,
            'tickets' => $tickets,
            'users' =>  $users,
        ]);
    }

    public function test() {
        Http::$app->response()->json([
            'hello' => 123
        ]);
    }
}