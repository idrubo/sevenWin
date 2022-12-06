<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

use App\Http\Controllers\authC;
use App\Http\Controllers\playerC;
use App\Http\Controllers\throwC;

Route::post ('/players/', [authC::class, 'register']);
Route::post ('/login/',   [authC::class, 'login']);

Route::middleware ('auth:api')->group (function ()
{
  Route::post ('/logout/', [authC::class, 'logout']);

  Route::put ('/players/{id}/', [playerC::class, 'modifyPlayer']);

  Route::post ('/players/{id}/games/', [throwC::class, 'throw']);
});

