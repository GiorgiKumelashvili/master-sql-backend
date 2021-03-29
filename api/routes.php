<?php
/** @noinspection PhpExpressionResultUnusedInspection */

/*
 * |=============================================
 * | Register Api Methods from controller
 * |============================================
 */

use app\core\Routing\Route;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

Route::get('/test', [\app\api\controllers\TableController::class, 'test']);
Route::post('/', [\app\api\controllers\TableController::class, 'index']);
