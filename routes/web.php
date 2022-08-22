<?php

use App\Http\Controllers\AboutusController;
use App\Http\Controllers\Auth\Admin\AuthController;
use App\Http\Controllers\Auth\User\AuthController as UserAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Frontend\LocalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\VideosController;
use Illuminate\Support\Facades\Route;

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
// Language Route start
Route::group(['middleware' => ['verify.web','local'] ], function () {
    Route::get('locale/{locale}',[LocalController::class ,'switchlang'])->name('locale.set');
    Route::post('set-lang',[LocalController::class,"langDataUpdate"])->name("set-language");
    Route::get('lang-page',function(){
        return view('language');
    });
});
// Language Route end
// Route::group(['middleware'=>'guest'],function(){

    Route::get('/', [HomeController::class, "index"])->name("home");
    Route::get('/category/{slug}', [HomeController::class, "view_category"])->name("view_category");
    Route::get('/video/{slug}', [HomeController::class, "view_video"])->name("view_video");
    Route::get('/about-us', [HomeController::class, "about"])->name("about");
    Route::get('/dmca', [HomeController::class, "dcma"])->name("dcma");
    Route::any('/contact-us', [HomeController::class, "contactUs"])->name("contact-us");
    Route::any('/search', [HomeController::class, "search"])->name("search");
// });

// User Route start
Route::group(['middleware' => ['verify.web'], 'prefix'=>"admin",'as'=>'admin.' ], function () {
    Route::get("/",[UserAuthController::class,"index"])->name("home");
    Route::post("change_password",[UserAuthController::class,"changePassword"])->name("change-password");

    Route::get('about-us', [AboutusController::class, "index"])->name("about-us");
    Route::any('dcma', [AboutusController::class, "dcma"])->name("dcma");

    Route::post('about/update/{id}', [AboutusController::class, "update"])->name("about.update");
    // Category Route Start
    Route::get('/category', [CategoryController::class, "index"])->name("category");
    Route::get('/category/new', [CategoryController::class, "new"])->name("category.new");
    Route::post('/category/store', [CategoryController::class, "store"])->name("category.store");
    Route::get('/category/edit/{id}', [CategoryController::class, "edit"])->name("category.edit");
    Route::post('/category/update/{id}', [CategoryController::class, "update"])->name("category.update");
    Route::get('/category/delete/{id}', [CategoryController::class,"delete"])->name("category.delete");

    // Videos Route Start
    Route::get('/videos', [VideosController::class, "index"])->name("videos");
    Route::get('/videos/new', [VideosController::class, "new"])->name("videos.new");
    Route::post('/videos/store', [VideosController::class, "store"])->name("videos.store");
    Route::get('/videos/edit/{id}', [VideosController::class, "edit"])->name("videos.edit");
    Route::post('/videos/update/{id}', [VideosController::class, "update"])->name("videos.update");
    Route::get('/videos/delete/{id}', [VideosController::class,"delete"])->name("videos.delete");



});
Route::group(['prefix' => '/'], function () {

    Route::get("show-mail-template",function(){
        return view('mail');
    });
    Route::group(['middleware'=>'if.login'],function(){
        Route::get('login', [UserAuthController::class,'login'])->name('login');
        Route::post('login', [UserAuthController::class,'authenticate']);
    });
    Route::get('logout', [UserAuthController::class,'logout'])->name("logout");


    Route::get('verify-email',[UserAuthController::class,'verifyEmail']);
    Route::get('sent-email',[UserAuthController::class,'sendMail']);

    Route::get('forgot-password', function () {
        return view("Frontend.User.forgot-password");
    })->name("forgot-password");
    Route::post('forgot-password',[UserAuthController::class,'forgotPassword']);

    Route::get('set-password', function () {
        return view("Frontend.User.set-password");
    })->name("set-password");

    Route::post("set-password/{id}",[UserAuthController::class,"setPassword"]);

});
// User Route end

