<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\MatriculeController;

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
Route::middleware(['admin', '2fa'])->group(function () {
 
    Route::get("/dashboard", [AdminController::class, 'index'])->name('adminDashboard');
    Route::get("/manage_user", [UserController::class, 'manage_users'])->name('man_user');
    Route::post("/user_manager/{action}", [UserController::class, 'del_save_user'])->name('user_manager');
    Route::get("/users/electeurs", [UserController::class, 'users'])->name('user.elct');

    Route::get("/manage_can", [CandidateController::class, 'manage_candi'])->name('man_candidate');
    Route::get("/manage_candidate", [CandidateController::class, 'manage_candidate'])->name('man_can');
    Route::post("/candidate_manager/{action}", [CandidateController::class, 'del_save_can'])->name('candidate_manager');

    
});


Route::middleware(['sadmin', '2fa'])->group(function () {

    Route::get("/users/admin", [AdminController::class, 'admin'])->name('user.admin');
    Route::get("/users/super-admin", [AdminController::class, 'sadmin'])->name('user.super.admin');

    Route::get("/matricule_index", [MatriculeController::class, 'index'])->name('matricule.index');
    Route::get("/manage_matricule", [MatriculeController::class, 'manage_matricules'])->name('man_matricule');
    Route::post("/matricule_manager/{action}", [MatriculeController::class, 'del_save_matricule'])->name('matricule_manager');
    
    Route::get("/categories", [CategoryController::class, 'category'])->name('categoy_list');
    Route::post("/category/{action}", [CategoryController::class, 'del_save_cat'])->name('cat');

    Route::get("/logvote/{category}", [VoteController::class, 'log'])->name('logvote');
    
});


Route::middleware(['auth', '2fa'])->group(function () {
    
    Route::get("/vote", [VoteController::class, 'index'])->name('userVote');
    Route::post("/vote-submit", [VoteController::class, 'submit'])->name('userVote.submit');
    Route::get("/about-candidate", [VoteController::class, 'about'])->name('vote.about.candidate'); 
    Route::get("/about-candidates/{voter}", [VoteController::class, 'aboutCandate'])->name('show.about.candidate');    
    Route::get("/result", [VoteController::class, 'result'])->name('vote.result');

});



    //session()->put('hello', $user);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');



Route::get('2fa', [App\Http\Controllers\TwoFAController::class, 'index'])->name('2fa.index');
Route::post('2fa', [App\Http\Controllers\TwoFAController::class, 'store'])->name('2fa.post');
Route::get('2fa/reset', [App\Http\Controllers\TwoFAController::class, 'resend'])->name('2fa.resend');

Auth::routes(['register' => false, 'reset' => false]);

