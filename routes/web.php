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
use App\Http\Controllers\AdminStaffsController;
use App\Http\Controllers\AdminTicketsController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\AdminCategoriesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;


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

Route::get('/categories', [CategoriesController::class, 'create']);

Route::get('products/category/{productCategory:id}', [ProductsController::class, 'create']);

Route::middleware('can:staff')->group(function(){
    Route::get('/staff/dashboard', [StaffDashboardController::class, 'create']);
    Route::get('/staff/tickets', [StaffTicketsController::class, 'create']);
    Route::patch('/tickets/ticket/{ticket:id}', [StaffTicketsController::class, 'update']);
});

Route::middleware('can:admin')->group(function(){
    Route::get('/admin/panel', [AdminPanelController::class, "create"]);
    Route::get('/admin/users', [AdminUsersController::class, "create"]);
    Route::get('/admin/users/{user:id}', [AdminUsersController::class, "show"])->name("panel.users.show");
    Route::patch('/admin/users/{user:id}', [AdminUsersController::class, "update"]);
    Route::get('/admin/tickets', [AdminTicketsController::class, "create"]);
    Route::get('/admin/staffs', [AdminStaffsController::class, "create"]);
    Route::get('/admin/categories', [AdminCategoriesController::class, "create"]);
    Route::get('/admin/category/{category:id}', [AdminCategoriesController::class, "show"])->name("panel.categories.show");
    Route::get('/admin/categories/add', [AdminCategoriesController::class, "add"]);
    Route::patch('/admin/category/{category:id}', [AdminCategoriesController::class, "update"]);
    Route::get('/admin/products', [AdminProductsController::class, "create"]);
    Route::get('/admin/products/{product:id}', [AdminProductsController::class, "show"])->name("panel.products.show");
    Route::patch('/admin/products/{product:id}', [AdminProductsController::class, "update"]);
});
