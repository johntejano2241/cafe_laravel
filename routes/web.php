<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/listen', function () {
    Artisan::call('queue:listen');
});

Route::get('/clearconfig', function () {

    Artisan::call('config:clear');
});

Route::get('/clearcache', function () {

    Artisan::call('config:cache');
});

Route::get('/', function () {
    return view('welcome');
})->name('admin.home');


Route::get('/admin/dashboard', function () {
    return view('admin.home');
});


Route::get('/admin/view/users', function () {
    return view('send');
});


Route::get('/admin/report', function () {
    return view('report');
});


// Landing Page
Route::get('/forgot/password/', [UserController::class, 'landingRequestPassword']);

// After Register
Route::get('/verify/email/{token}', [UserController::class, 'verifyEmail'])->name('verify.email');

// Requesting for Forgot Password
Route::post('/user/forgot/password/', [UserController::class, 'requestForgotPassword'])->name('request.password');

// Email Password Token
Route::get('/forgot/password/{token}', [UserController::class, 'forgotPassword'])->name('forgot.password');

Route::post('/reset/password', [UserController::class, 'userNewPassword'])->name('reset.password');




Route::post('/admin/check/login', [AdminController::class, "checkLogin"])->name('admin.login');

Route::middleware(['AdminMiddleware'])->group(function () {


    Route::get('/admin/logout', [AdminController::class, "adminLogout"])->name('admin.logout');


    Route::get('/admin/test', [AdminController::class, "userTest"]);


    Route::get('/admin/dashboard', [AdminController::class, "adminDashboard"]);



    Route::get('/admin/trivia', [AdminController::class, "adminTrivia"]);


    Route::get('/admin/quiz', [AdminController::class, "adminQuiz"]);


    Route::get('/admin/view-accounts', [AdminController::class, "adminViewAccount"]);


    Route::get('/admin/setting', [AdminController::class, "adminSetting"]);


    Route::post('/update/setting', [AdminController::class, "updateAdminAccount"])->name('admin.update');



    // Create & Update Trivia
    Route::post('/admin/create/trivia', [AdminController::class, "createTrivia"])->name('create.trivia');



    Route::post('/admin/delete/trivia', [AdminController::class, "deleteTrivia"])->name('delete.trivia');




    // Create & Update Quiz
    Route::post('/admin/create/quiz', [AdminController::class, "createQuiz"])->name('create.quiz');

    Route::post('/admin/delete/quiz', [AdminController::class, "deleteQuiz"])->name('delete.quiz');
});








// Route Login and Register User

Route::get('/admin/password/{password}', function ($password) {

    dd(Hash::make($password . "OurSAf3Pepper$$"));
});
