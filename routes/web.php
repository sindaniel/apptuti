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


Route::middleware(['auth', 'role:admin'])->group(function () {


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    // Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');
    Route::post('/products/{product}/images', [ProductController::class, 'images'])->name('products.images');
    Route::delete('/products/{product}/images/{image}', [ProductController::class, 'images_delete'])->name('products.images_delete');

    Route::delete('/products/{product}/add_combined', [ProductController::class, 'add_combined'])->name('products.add_combined');
    Route::delete('/products/{product}/sync_combined', [ProductController::class, 'sync_combined'])->name('products.sync_combined');
   
    Route::get('/products/{product}/combinations{combination}', [ProductCombinationsController::class, 'remove_combination'])->name('products.remove_combination');
    
    
    Route::resource('brands', BrandController::class);
    Route::resource('taxes', TaxController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('products', ProductController::class);
    Route::resource('products.combinations', ProductCombinationsController::class)->only([ 'store', 'update']);
    Route::resource('categories', CategoryController::class);
    Route::resource('labels', LabelController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('bonifications', BonificationController::class);

    Route::resource('variations', VariationController::class);
    Route::resource('variations.items', VariationItemController::class);



    
    Route::get('/profile', [VendorController::class, 'index'])->name('profile.update');
   # Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
