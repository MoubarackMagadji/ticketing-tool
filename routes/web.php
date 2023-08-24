<?php

use App\Models\Ticket;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeptController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\SubcategoryController;

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
    Route::post('/users', [UserController::class, 'index'])->name('users');
    
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

    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

    Route::prefix('category')->group(function(){
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/create', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/edit/{category}', [CategoryController::class, 'update'])->name('category.update');
    });

    Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories');

    Route::prefix('subcategory')->group(function(){
        Route::get('/create', [SubcategoryController::class, 'create'])->name('subcategory.create');
        Route::post('/create', [SubcategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/edit/{subcategory}', [SubcategoryController::class, 'edit'])->name('subcategory.edit');
        Route::post('/edit/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategory.update');
    });

    Route::get('/tickets', [TicketController::class,'index'])->name('tickets');

    Route::prefix('ticket')->group(function(){
        Route::get('/show/{ticket}', [TicketController::class, 'show'])->name('ticket.show');
        Route::get('/create', [TicketController::class, 'create'])->name('ticket.create');
        Route::post('/create', [TicketController::class, 'store'])->name('ticket.store');
        
        // Route::get('/edit/{ticket}', [TicketController::class, 'edit'])->name('ticket.edit');
        // Route::post('/edit/{ticket}', [TicketController::class, 'update'])->name('ticket.update');

        Route::get('/changecategories/{ticket}',[TicketController::class, 'changecategories'])->name('ticket.changecategories');
        Route::post('/changecategories/{ticket}',[TicketController::class, 'changecategoriespost'])->name('ticket.changecategoriespost');
        Route::post('/changestatuspriority/{ticket}',[TicketController::class, 'changestatuspriority'])->name('ticket.changestatuspriority');

        Route::post('/comment/{ticket}', [CommentController::class, 'store'])->name('commentpost');

        Route::prefix('usersonticket')->group(function(){
            Route::get('/{ticket}', [TicketController::class, 'usersonticketview'])->name('usersonticketview');
            Route::post('/{ticket}', [TicketController::class, 'usersonticketviewadd'])->name('usersonticketviewadd');

            Route::post('/usersonticket/{ticket}/makemain/', [TicketController::class, 'usersonticketviewmakemain'])->name('usersonticketviewmakemain');
            Route::post('/usersonticket/{ticket}/deactivate/', [TicketController::class, 'usersonticketviewdeactivate'])->name('usersonticketviewdeactivate');
            Route::post('/usersonticket/{ticket}/activate/', [TicketController::class, 'usersonticketviewactivate'])->name('usersonticketviewactivate');
        });
        
        
        
    
    });
});

