<?php
/** @noinspection PhpIncludeInspection */

namespace app\core;

use app\core\Helpers\Bootup;
use app\core\Helpers\FileManager;
use app\core\Http\Http;
use app\core\Routing\Route;

class Main {
    public function __construct() { }

    public function start() {
        // Load enviroment variables and set errors (shown or not)
        Bootup::LOAD_ENV();
        Bootup::SET_ERRORS();

        // Initialize app for routes
        $app = new Http();

        // require routes
        require_once FileManager::fullpath("api/routes.php");

        // validate routes
        Route::validateUnkownUrl();
    }
}