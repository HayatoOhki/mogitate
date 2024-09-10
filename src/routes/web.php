<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::prefix('products')->name('products.')->group(function() {
    // 商品一覧ページ表示
    Route::get('/', [ProductController::class, 'index'])->name('index');
    // 商品検索
    Route::get('/search', [ProductController::class, 'search'])->name('search');
    // 商品登録ページ表示
    Route::get('/register', [ProductController::class, 'create'])->name('create');
    // 商品登録
    Route::post('/register', [ProductController::class, 'store'])->name('store');
    // 商品詳細ページ表示
    Route::get('/{product_id}', [ProductController::class, 'detail'])->name('detail');
    // 商品更新
    Route::put('/{product_id}/update', [ProductController::class, 'update'])->name('update');
    // 商品削除
    Route::delete('/{product_id}/delete', [ProductController::class, 'destroy'])->name('destroy');
});
