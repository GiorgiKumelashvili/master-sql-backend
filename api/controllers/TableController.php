<?php
/**
 * @noinspection SqlResolve, SqlNoDataSourceInspection
 */

namespace app\api\controllers;


use app\core\Database\DB;
use app\core\Helpers\Helper;
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
            'movies' => $movies,
            'tickets' => $tickets,
            'users' => $users,
        ]);
    }

    public function tableData() {
        $data = Http::$app->request()->getBodyData();
        $exampleID = $data['exampleID'];
        $queryID = $data['queryID'];

        $query = $this->retrieveQuery($exampleID, $queryID);

        $data = DB::RawQueryExecute($query);

        Http::$app->response()->json([
            'data' => $data
        ]);
    }

    public function retrieveQuery(string $exampleId, string $queryId): string {
        $mainDB = $this->moviesDB;

        $data = [
            "1000001" => [
                "1000001001" => "SELECT name, genre FROM {$mainDB};",
                "1000001002" => "SELECT * FROM {$mainDB};",
            ],
            "1000002" => [
                "1000002001" => "SELECT DISTINCT age_restriction FROM {$mainDB};",
            ],
            "1000003" => [
                "1000003001" => "SELECT * FROM {$mainDB} WHERE genre='Documentary';",
                "1000003002" => "SELECT * FROM {$mainDB} WHERE age_restriction=18;",
            ],
            "1000004" => [
                "1000004001" => "SELECT * FROM {$mainDB} WHERE age_restriction=18 AND genre='Documentary';",
                "1000004002" => "SELECT * FROM {$mainDB} WHERE genre='Documentary' OR genre='Comedy|War';",
                "1000004003" => "SELECT * FROM {$mainDB} WHERE NOT age_restriction=18;",
                "1000004004" => "SELECT * FROM {$mainDB} WHERE age_restriction=18 AND (genre='Documentary' OR genre='Comedy|War');",
                "1000004005" => "SELECT * FROM {$mainDB} WHERE NOT age_restriction=18 AND NOT age_restriction=20;",
            ],
            "1000005" => [
                "1000005001" => "SELECT * FROM {$mainDB} ORDER BY age_restriction;",
                "1000005002" => "SELECT * FROM {$mainDB} ORDER BY age_restriction DESC;",
                "1000005003" => "SELECT * FROM {$mainDB} ORDER BY age_restriction, name;",
                "1000005004" => "SELECT * FROM {$mainDB} ORDER BY age_restriction ASC, name DESC;",
            ],
            "1000006" => [
                "1000006001" => "",
            ],
            "1000007" => [
                "1000007001" => "SELECT name, age_restriction FROM {$mainDB} WHERE name IS NULL;",
                "1000007002" => "SELECT name, age_restriction FROM {$mainDB} WHERE name IS NOT NULL;",
            ],
            "1000008" => [
                "1000008001" => "",
            ],
            "1000009" => [
                "1000009001" => "",
            ],
            "1000010" => [
                "1000010001" => "SELECT * FROM {$mainDB} LIMIT 3;",
            ],
            "1000011" => [
                "1000011001" => "SELECT MIN(duration) AS SmallestDuration FROM {$mainDB};",
                "1000011002" => "SELECT MAX(duration) AS LargestDuration FROM {$mainDB};",
            ],
            "1000012" => [
                "1000012001" => "SELECT COUNT(review) FROM {$mainDB};",
                "1000012002" => "SELECT AVG(review) FROM {$mainDB};",
                "1000012003" => "SELECT SUM(review) FROM {$mainDB};",
            ],
            "1000013" => [
                "1000013001" => "SELECT * FROM {$mainDB} m2 ;",
                "1000013002" => "SELECT * FROM {$mainDB} WHERE name LIKE 'a%';",
                "1000013003" => "SELECT * FROM {$mainDB} WHERE name LIKE '%g';",
                "1000013004" => "SELECT * FROM {$mainDB} WHERE name LIKE '%ow%';",
                "1000013005" => "SELECT * FROM {$mainDB} WHERE name LIKE '_u%';",
                "1000013006" => "SELECT * FROM {$mainDB} WHERE name LIKE 'a__%';",
                "1000013007" => "SELECT * FROM {$mainDB} WHERE name LIKE 'c%n';",
                "1000013008" => "SELECT * FROM {$mainDB} WHERE name NOT LIKE 'a%';",
                "1000013009" => "SELECT * FROM {$mainDB} WHERE name LIKE 's_a_ow';",
                "1000013010" => "SELECT * FROM {$mainDB} WHERE name REGEXP '^[as]';",
                "1000013011" => "SELECT * FROM {$mainDB} WHERE name REGEXP '^[a-g]';",
            ],
            "1000014" => [
                "1000014001" => "SELECT * FROM {$mainDB} WHERE age_restriction IN (18, 19);",
                "1000014002" => "SELECT * FROM {$mainDB} WHERE age_restriction NOT IN (18, 19);",
            ],
            "1000015" => [
                "1000015001" => "SELECT * FROM {$mainDB} WHERE duration BETWEEN 1.5 AND 2.2;",
                "1000015002" => "SELECT * FROM {$mainDB} WHERE duration BETWEEN 1.5 AND 2.2 AND review NOT IN (2.6);",
                "1000015003" => "SELECT * FROM {$mainDB} WHERE genre BETWEEN 'Documentary' AND 'Comedy|War' ORDER BY genre;",
            ],
            "1000016" => [
                "1000016001" => "SELECT id AS movie_id, name AS movie_name FROM {$mainDB};",
                "1000016002" => "SELECT id AS movie_id, name AS 'movie name' FROM {$mainDB};",
                "1000016003" => "SELECT name, CONCAT(id,', ',name,', ',genre,', ',age_restriction) AS full_data FROM {$mainDB};",
            ],
            "1000017" => [
                "1000017001" => "SELECT t.id as ticket_id, m.* FROM tickets t  INNER JOIN movies m  ON t.movie_id = m.id;",
                "1000017002" => "SELECT u.id as user_id, u.name, u.age, u.gender, m.name, m.duration, m.age_restriction FROM ((tickets t INNER JOIN users u ON u.ticket_id = t.id) INNER JOIN movies m ON t.movie_id = m.id) ORDER BY user_id;",
            ],
            "1000018" => [
                "1000018001" => "SELECT * FROM tickets LEFT JOIN movies m  ON tickets.placeholder_id = m.id;",
            ],
            "1000019" => [
                "1000019001" => "SELECT * FROM tickets RIGHT JOIN movies m ON tickets.placeholder_id = m.id;",
            ],
            "1000020" => [ // changed to union
                "1000020001" => "SELECT name, age_restriction FROM movies UNION SELECT id, placeholder_id FROM tickets;",
            ],
            "1000021" => [
                "1000021001" => "SELECT m.id, t.id as ticket_id, m.name FROM tickets t,movies m WHERE t.movie_id = m.id ORDER BY t.movie_id;",
            ],

			//    "1000022" => [
			//        "1000022001" => "SELECT genre FROM {$mainDB} UNION SELECT genre FROM Suppliers ORDER BY genre;",
			//        "1000022002" => "SELECT genre FROM {$mainDB} UNION ALL SELECT genre FROM Suppliers ORDER BY genre;",
			//        "1000022003" => "SELECT genre, age_restriction FROM {$mainDB} WHERE age_restriction='Germany' UNION SELECT genre, age_restriction FROM Suppliers WHERE age_restriction='Germany' ORDER BY genre;",
			//    ],
            "1000023" => [
                "1000023001" => "SELECT COUNT(review), age_restriction FROM movies GROUP BY age_restriction;",
                "1000023002" => "SELECT COUNT(review) as review_count, age_restriction FROM movies GROUP BY age_restriction ORDER BY review_count  DESC;",
            ],

            "1000024" => [
                "1000024001" => "SELECT COUNT(review), age_restriction FROM movies GROUP BY age_restriction HAVING age_restriction > 18;",
                "1000024002" => "SELECT COUNT(review), age_restriction FROM movies GROUP BY age_restriction HAVING age_restriction > 18 ORDER BY age_restriction  DESC;",
            ],

            "1000025" => [
                "1000025001" => "SELECT id as ticket_id from tickets WHERE EXISTS (SELECT id FROM movies WHERE tickets.id = movies.id AND movies.id > 7);",
            ],

            "1000026" => [
                "1000026001" => "SELECT * FROM users WHERE age > ANY (SELECT age_restriction FROM movies);",
                "1000026002" => "SELECT * FROM users WHERE age > All (SELECT age_restriction FROM movies);",
            ],

            "1000027" => [
                "1000027001" => "SELECT name, age, CASE WHEN age < 15 THEN 'Some movies are bad for kids under 15' WHEN age < 18 THEN 'Some movies are acceptable' ELSE 'Some movies +18 are acceptable' END AS 'Age restriction text' FROM users;",
            ],
            "1000028" => [
                "1000028001" => "SELECT IFNULL(placeholder_id, 'nothing') as id FROM tickets;",
                "1000028002" => "SELECT COALESCE(placeholder_id, 'nothing') as id FROM tickets;",
            ],
        ];

        return $data[$exampleId][$queryId];
    }

	public function test(){
		echo "hello" . PHP_EOL;
		echo Helper::env('DB_HOST') . PHP_EOL;
        echo Helper::env('DB_HOST') . PHP_EOL;
        echo Helper::env('DB_DATABASE') . PHP_EOL;
        echo Helper::env('DB_PORT') . PHP_EOL;
        echo Helper::env('DB_USERNAME') . PHP_EOL;
        echo Helper::env('DB_PASSWORD') . PHP_EOL;
	}
}