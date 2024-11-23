<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EraController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

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


Route::middleware(['auth', 'role:admin'])->group(function () {
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/user', [UserController::class ,'index'])->name('user.index');
Route::get('/user/{id}/{active}', [UserController::class ,'update'])->name('user.edit');


Route::get('/product', [ProductController::class ,'index'])->name('product.index');
Route::get('/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/{id}/show', [ProductController::class, 'show'])->name('product.show');
Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
Route::put('/product/{id}/update', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/{id}/status/{visible}', [ProductController::class, 'updateStatus'])->name('product.Status');

Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::delete('/category/{id}/destroy/', [CategoryController::class, 'destroy'])->name('category.destroy');
Route::get('/category/{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{id}/update', [CategoryController::class, 'update'])->name('category.update');

Route::get('/era', [EraController::class, 'index'])->name('era.index');
Route::get('/era/create', [EraController::class, 'create'])->name('era.create');
Route::post('/era/store', [EraController::class, 'store'])->name('era.store');
Route::get('/era/{id}/edit', [EraController::class, 'edit'])->name('era.edit');
Route::put('/era/{id}/update', [EraController::class, 'update'])->name('era.update');
Route::delete('/era/{id}/destroy', [EraController::class, 'destroy'])->name('era.destroy');


Route::get('/store', [StoreController::class, 'index'])->name('store.index');
Route::get('/store/create', [StoreController::class, 'create'])->name('store.create');
Route::post('/store/store', [StoreController::class, 'store'])->name('store.store');
Route::get('/store/{id}/show', [StoreController::class, 'show'])->name('store.show');
Route::get('/store/{id}/status/{visible}', [StoreController::class, 'toggleStatus'])->name('store.Status');

Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
Route::get('/review/{id}/show', [ReviewController::class, 'show'])->name('review.show');
Route::get('/review/{id}/status/{visible}', [ReviewController::class, 'status'])->name('review.status');


Route::get('/comment', [CommentController::class, 'index'])->name('comment.index');
Route::get('/comment/{id}/show', [CommentController::class, 'show'])->name('comment.show');
Route::get('/comment/{id}/status/{visible}', [CommentController::class, 'status'])->name('comment.status');


Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{id}/show', [BlogController::class, 'show'])->name('blog.show');
Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::put('/blog/{id}/update', [BlogController::class, 'update'])->name('blog.update');
Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::post('blog/store' , [BlogController::class, 'store'])->name('blog.store');
Route::delete('/blog/{id}/destroy', [BlogController::class, 'destroy'])->name('blog.destroy');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
