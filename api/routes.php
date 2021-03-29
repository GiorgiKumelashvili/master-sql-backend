<?php
/** @noinspection PhpExpressionResultUnusedInspection */

/*
 * |=============================================
 * | Register Api Methods from controller
 * |============================================
 */

use app\core\Routing\Route;


Route::get('/', [\app\api\controllers\TableController::class, 'log']);
Route::get('/database/reset', [\app\api\controllers\DefaultTableController::class, 'resetData']);

/*todo
 * SQL Tutorial
 * SQL Intro
 * SQL Syntax
 * SQL Select
 * SQL Select Distinct
 * SQL Where
 * SQL And, Or, Not
 * SQL Order By
 * SQL Insert Into
 * SQL Null Values
 * SQL Update
 * SQL Delete
 * SQL Select Top
 * SQL Min and Max
 * SQL Count, Avg, Sum
 * SQL Like
 * SQL Wildcards
 * SQL In
 * SQL Between
 * SQL Aliases
 * SQL Joins
 * SQL Inner Join
 * SQL Left Join
 * SQL Right Join
 * SQL Full Join
 * SQL Self Join
 * SQL Union
 * SQL Group By
 * SQL Having
 * SQL Exists
 * SQL Any, All
 * SQL Select Into
 * SQL Insert Into Select
 * SQL Case
 * SQL Null Functions
 * SQL Stored Procedures
 * SQL Comments
 * SQL Operators
 *
 * // each its own stuff
 * SQL Keywords
 * MySQL Functions
 * SQL Server Functions
 * MS Access Functions
 */
