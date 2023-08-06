<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('index');
})->middleware('guest')->name('home');

Route::post('/loginValidate', [UserController::class, 'authenticate'])->name('authenticate')->middleware('guest');

Route::prefix('staffs')->middleware('auth')->group(function(){

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    
    Route::prefix('user')->group(function(){
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
    });

    
    Route::get('/depts', [DeptController::class, 'index'])->name('depts');
    
    Route::prefix('dept')->group(function(){
        Route::get('/create', [DeptController::class, 'create'])->name('dept.create');
        Route::post('/create', [DeptController::class, 'store'])->name('dept.store');
        Route::get('/edit/{dept}', [DeptController::class, 'edit'])->name('dept.edit');
        Route::put('/edit/{dept}', [DeptController::class, 'update'])->name('dept.update');
    });

});

