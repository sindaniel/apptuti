<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BonificationController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductCombinationsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\VariationController;
use App\Http\Controllers\VariationItemController;
use App\Http\Controllers\VendorController;

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


Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/categoria-producto/{slug}', [PageController::class, 'category'])->name('category');
Route::get('/categoria-producto/{slug}/{slug2?}', [PageController::class, 'category'])->name('category2');

Route::get('/producto/{slug}', [PageController::class, 'product'])->name('product');

Route::get('/etiqueta-producto/{slug}', [PageController::class, 'label'])->name('label');


Route::get('/proveedores', [PageController::class, 'brands'])->name('brands');
Route::get('/proveedores/{brand}', [PageController::class, 'brand'])->name('brand');




require __DIR__.'/auth.php';
