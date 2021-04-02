<?php
/** @noinspection PhpExpressionResultUnusedInspection */

/*
 * |=============================================
 * | Register Api Methods from controller
 * |============================================
 */

use app\api\controllers\DefaultTableController;
use app\api\controllers\TableController;
use app\core\Routing\Route;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

// For master-sql
Route::post('/', [TableController::class, 'index']);
Route::post('/database/tabledata', [TableController::class, 'tableData']);

// [ADMIN]
Route::get('/', [TableController::class, 'test']);
Route::get('/database/tabledata', [TableController::class, 'tableData']);
Route::get('/database/reset', [DefaultTableController::class, 'reset']);