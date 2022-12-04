<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;

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
Route::middleware(['admin'])->group(function () {
 
    Route::get("/dashboard", [AdminController::class, 'index'])->name('adminDashboard');
    Route::get("/users/electeurs", [AdminController::class, 'users'])->name('user.elct');
    Route::get("/users/admin", [AdminController::class, 'admin'])->name('user.admin');
    Route::get("/manage_can", [AdminController::class, 'manage_candi'])->name('man_candidate');
    Route::get("/manage_candidate", [AdminController::class, 'manage_candidate'])->name('man_can');
    Route::get("/manage_user", [AdminController::class, 'manage_users'])->name('man_user');
    Route::get("/categories", [AdminController::class, 'category'])->name('categoy_list');
    Route::post("/category/{action}", [AdminController::class, 'del_save_cat'])->name('cat');
    Route::post("/user_manager/{action}", [AdminController::class, 'del_save_user'])->name('user_manager');
    Route::post("/candidate_manager/{action}", [AdminController::class, 'del_save_can'])->name('candidate_manager');

    
});

Route::middleware(['auth'])->group(function () {
    
    Route::get("/vote", [VoteController::class, 'index'])->name('userVote');
    Route::post("/vote-submit", [VoteController::class, 'submit'])->name('userVote.submit');
    Route::get("/about-candidate", [VoteController::class, 'about'])->name('vote.about.candidate'); 
    Route::get("/about-candidates/{voter}", [VoteController::class, 'aboutCandate'])->name('show.about.candidate');    
    Route::get("/result", [VoteController::class, 'result'])->name('vote.result');

});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');





Auth::routes(['register' => false, 'reset' => false]);

