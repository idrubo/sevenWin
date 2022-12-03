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

use App\Http\Controllers\authController;
use App\Http\Controllers\playerController;

Route::post ('/register/', [authController::class, 'register']);
Route::post ('/login/',    [authController::class, 'login']);

Route::middleware ('auth:api')->group (function ()
{
  Route::post ('/logout/', [authController::class, 'logout']);
  Route::post ('/player/', [playerController::class, 'showPlayer']);
});

