<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommentController;
use App\Models\Comments;

Route::get('/', function () {
    return view('welcome');
})->middleware('check-time-message');


Route::prefix('category')->controller(CategoryController::class)->group(function () {
    Route::get('/', 'index')->name('category.index');
    Route::post('create', 'create');
    Route::put('update/{uuid}', 'update');
    Route::delete('delete/{uuid}', 'delete');
    Route::get('{slug}', 'detail');
});

Route::prefix('book')->controller(BookController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('create', 'create');
    Route::put('update/{uuid}', 'update');
    Route::delete('delete/{uuid}', 'delete');
    Route::get('{uuid}', 'detail');
});
Route::post('/book/{uuid}/{id}', [CommentController::class, 'add'])->name('comment');









