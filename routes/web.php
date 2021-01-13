<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\JournalController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/authors');

Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
Route::get('/authors/create', [AuthorController::class, 'create'])->name('authors.create');
Route::get('/authors/show/{author}', [AuthorController::class, 'show'])->name('authors.show');
Route::get('/authors/edit/{author}', [AuthorController::class, 'edit'])->name('authors.edit');
Route::post('/authors/store', [AuthorController::class, 'store'])->name('authors.store');
Route::post('/authors/update/{author}', [AuthorController::class, 'update'])->name('authors.update');
Route::delete('/authors/destroy/{author}', [AuthorController::class, 'destroy'])->name('authors.destroy');

Route::get('/journals', [JournalController::class, 'index'])->name('journals.index');
Route::get('/journals/create', [JournalController::class, 'create'])->name('journals.create');
Route::get('/journals/show/{journal}', [JournalController::class, 'show'])->name('journals.show');
Route::get('/journals/edit/{journal}', [JournalController::class, 'edit'])->name('journals.edit');
Route::post('/journals/store', [JournalController::class, 'store'])->name('journals.store');
Route::post('/journals/update/{journal}', [JournalController::class, 'update'])->name('journals.update');
Route::delete('/journals/destroy/{journal}', [JournalController::class, 'destroy'])->name('journals.destroy');
