<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\updateSKUController;

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
	return view('welcome');
});

Route::get('/dashboard', function () {
	return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function () {
	Route::get('/upload-image', [ImageController::class, 'index']);
	Route::post('/upload-image', [ImageController::class, 'store'])->name('reorder.form');
	Route::get('/upload-image2', [ImageController::class, 'searchSKU'])->name('search.sku.form');
});

Route::group(['middleware' => ['auth']], function () {
	Route::get('/update-sku', [updateSKUController::class, 'index']);
	Route::post('/update-sku', [updateSKUController::class, 'importData'])->name('update.sku');
});

Route::group(['middleware' => ['auth']], function(){
	Route::resource('roles', RoleController::class);
	Route::resource('users', RoleController::class);
	Route::resource('products', RoleController::class);
});


require __DIR__.'/auth.php';
