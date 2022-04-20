<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\BannerController;
use App\Http\Controllers\backend\BackendController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\frontend\FrontendController;

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

Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

Auth::routes();
//backend routes start
Route::name('backend.')->group(function(){
    Route::get('/dashboard', [BackendController::class, 'index'])->name('backend.home');
    Route::resource('/banner', BannerController::class)->except(['show']);
    Route::get('/banner/status/{banner}', [BannerController::class, 'statusUpdate'])->name('status.update');
    Route::get('/banner/restore/{id}', [BannerController::class, 'bannerRestore'])->name('banner.restore');
    Route::get('/banner/permanent/delete/{id}', [BannerController::class, 'permanentDelete'])->name('banner.permanent.delete');
    Route::resource('/category', CategoryController::class);
});
//backend routes ends
