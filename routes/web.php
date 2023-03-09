<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TicketRepliesController;
use App\Http\Controllers\StaffDashboardController;
use App\Http\Controllers\StaffTicketsController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\AdminUsersController;


Route::get('/', [SessionController::class, 'create']);
Route::post('/', [SessionController::class, 'store']);

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/home', [HomeController::class, 'create']);

Route::get('/tickets', [TicketController::class, 'index']);

Route::get('/tickets/ticket/{ticket:id}', [TicketController::class, 'show']);

Route::post('/tickets/{ticket:id}/replies/', [TicketRepliesController::class, 'store']);
Route::delete('/tickets/{ticket:id}/replies/{reply:id}', [TicketRepliesController::class, 'destroy']);

Route::get('/tickets/create', [TicketController::class, 'create']);
Route::post('/tickets/create', [TicketController::class, 'store']);

Route::middleware('can:staff')->group(function(){
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'create']);
    Route::get('/staff/tickets', [StaffTicketsController::class, 'create']);
    Route::patch('/tickets/ticket/{ticket:id}', [StaffTicketsController::class, 'update']);
});

Route::middleware('can:admin')->group(function(){
    Route::get('/admin/panel', [AdminPanelController::class, "create"]);
    Route::get('/admin/users', [AdminUsersController::class, "create"]);
});
