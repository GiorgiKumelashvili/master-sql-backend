<?php
require_once __DIR__ . "/vendor/autoload.php";

$main = new \app\core\Main();
$main->start();

//-------------------[ TEST AREA ]------------------------\\

echo "<br><br><hr>TEST AREA<hr><br><br>";

$db = new \app\core\Database\DB();
$db->show();
