<?php
require_once __DIR__ . "/vendor/autoload.php";


$arr = require_once "./api/routes.php";
print_r($arr);

echo  $_SERVER['PATH_INFO'] ?? '/';

