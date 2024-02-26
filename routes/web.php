<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\MailController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|


*/

Route::get('/', function () {
    return view('welcome');
});

// route::get('/send',[MailController::class,'send'])->name('send');

route::post('/check',[MailController::class,'check'])->name('check');
route::get('/form',[MailController::class,'form'])->name('form');
route::post('/newUser',[MailController::class,'newUser'])->name('newUser');
route::get('/send',[MailController::class,'send'])->name('send');
route::get('/verified/{id}',[MailController::class,'verified'])->name('verified');
route::get('/access',[ProfileController::class,'access'])->name('access');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('auth/google',[GoogleController::class,'redirectToGoogle']);
Route::get('auth/google/callback',[GoogleController::class,'handelGoogleCallBack']);
require __DIR__.'/auth.php';
