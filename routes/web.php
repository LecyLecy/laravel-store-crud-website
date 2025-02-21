<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ItemController::class, 'Title']);

Route::get('/login', [UserController::class, 'loginPage']);
Route::POST('/login', [UserController::class, 'loginValidation'])->name('login');
Route::get('/register', [UserController::class, 'registerPage']);
Route::POST('/register', [UserController::class, 'register']);
Route::POST('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function() {
    Route::get('/main', [ItemController::class, 'mainTitle'])->name('main');
    Route::POST('/plusCart/{item_id}/{user_id}', [CartController::class, 'plusCart'])->name('plusCart');
    Route::get('/faktur/{user_id}', [CartController::class, 'fakturPage'])->name('fakturPage');
    Route::DELETE('/deleteCart/{id}', [CartController::class, 'deleteCheckout'])->name('deleteCart');
    Route::POST('/buyCart/{user_id}', [CartController::class, 'buyItems'])->name('buyItems');
});

Route::middleware('admin')->group(function() {
    Route::get('/crud', [ItemController::class, 'crudTitle'])->name('crud');
    Route::get('/create', [ItemController::class, 'createPage']);
    Route::POST('/create', [ItemController::class, 'createItem']);
    Route::get('/createCategory', [CategoryController::class, 'createCategoryButton']);
    Route::POST('/createCategory', [CategoryController::class, 'createCategory'])->name('createCategory');
    Route::get('/update/{id}', [ItemController::class, 'updatePage']);
    Route::PATCH('/update/{id}', [ItemController::class, 'updateItem']);
    Route::DELETE('/delete/{id}', [ItemController::class, 'deleteItem'])->name('deleteItem');
});