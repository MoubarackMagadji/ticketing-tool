<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\PriorityController;

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
        Route::post('/create', [UserController::class, 'store'])->name('user.store');

        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/edit/{user}', [UserController::class, 'update'])->name('user.update');
        Route::post('/editpassword/{user}', [UserController::class, 'updatepassword'])->name('user.updatepassword');

        Route::get('/{user}', [UserController::class, 'show'])->name('user.show');
    });

    
    Route::get('/depts', [DeptController::class, 'index'])->name('depts');
    
    Route::prefix('dept')->group(function(){
        Route::get('/create', [DeptController::class, 'create'])->name('dept.create');
        Route::post('/create', [DeptController::class, 'store'])->name('dept.store');
        Route::get('/edit/{dept}', [DeptController::class, 'edit'])->name('dept.edit');
        Route::put('/edit/{dept}', [DeptController::class, 'update'])->name('dept.update');
    });

    Route::prefix('status')->group(function(){
        Route::get('/', [StatusController::class, 'index'])->name('status');
        Route::get('/create', [StatusController::class, 'create'])->name('status.create');
        Route::post('/create', [StatusController::class, 'store'])->name('status.store');
        Route::get('/edit/{status}', [StatusController::class, 'edit'])->name('status.edit');
        Route::post('/edit/{status}', [StatusController::class, 'update'])->name('status.update');
    });

    Route::get('/priorities', [PriorityController::class, 'index'])->name('priorities');

    Route::prefix('priority')->group(function(){
        Route::get('/create', [PriorityController::class, 'create'])->name('priority.create');
        Route::post('/create', [PriorityController::class, 'store'])->name('priority.store');
        Route::get('/edit/{priority}', [PriorityController::class, 'edit'])->name('priority.edit');
        Route::post('/edit/{priority}', [PriorityController::class, 'update'])->name('priority.update');

    });
});

