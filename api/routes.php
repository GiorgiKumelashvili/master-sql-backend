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

Route::post('/', [TableController::class, 'index']);

Route::post('/database/tabledata', [TableController::class, 'tableData']);

// [ADMIN]
Route::get('/database/reset', [DefaultTableController::class, 'reset']);
Route::get('/admin/test', [TableController::class, 'test']);