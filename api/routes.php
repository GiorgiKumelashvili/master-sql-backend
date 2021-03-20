<?php

/*
 * |=============================================
 * | Register Api Methods from controller
 * |============================================
 */

use app\api\controllers\Test;
use app\core\Routing\Route;

Route::get('/xx', [Test::class, 'testing']);
Route::get('/x', [Test::class, 'testing']);
Route::post('/', ['xx', 'xxx']);
