<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

//     Route::get('api/test', [UserController::class, "userTest"]);


// });

Route::post('/register', [UserController::class, "userRegister"]);


Route::post('/login', [UserController::class, "userLogin"]);



Route::group(['middleware' => ['auth:sanctum']], function () {


    // logout
    Route::get('/logout', [UserController::class, "userLogout"]);


    // api/test
    Route::get('/test', [UserController::class, "userTest"]);



    // Ruby
    Route::get('/get/ruby', [UserController::class, "getRuby"]);

    Route::post('/add/ruby', [UserController::class, "addRuby"]);

    Route::post('/sub/ruby', [UserController::class, "subRuby"]);



    // Items
    Route::get('/get/all/items', [UserController::class, "getAllItems"]);

    Route::post('/add/item', [UserController::class, "addItem"]);



    // Score
    Route::get('/get/all/scores', [UserController::class, "getAllScores"]);

    Route::post('/add/score', [UserController::class, "addScore"]);


    // Character
    Route::get('/get/character', [UserController::class, "getCharacter"]);

    Route::post('/set/character', [UserController::class, "setCharacter"]);



    // Player All Data
    Route::get('/get/player/data', [UserController::class, "getPlayerData"]);


    // Rewards
    Route::get('/get/all/reward', [UserController::class, "getAllReward"]);

    Route::post('/add/reward', [UserController::class, "setReward"]);


    // Get Trivia and Quiz
    Route::get('/get/trivia-quiz', [UserController::class, "getTriviaAndQuiz"]);


});
