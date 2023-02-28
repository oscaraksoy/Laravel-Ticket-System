<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\RegisterController;


Route::get('/', [SessionController::class, 'create']);
Route::post('/', [SessionController::class, 'store']);

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::post('/logout', [SessionController::class, 'destroy'])->middleware('auth');

Route::get('/home', [HomeController::class, 'create']);

Route::get('/tickets', [TicketController::class, 'index']);
Route::get('/tickets/ticket/{ticket:id}', [TicketController::class, 'show']);

Route::get('/tickets/create', [TicketController::class, 'create']);
Route::post('/tickets/create', [TicketController::class, 'store']);
