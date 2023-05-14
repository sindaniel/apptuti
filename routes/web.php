<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\LabelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaxController;
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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {


    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

  
    Route::resource('brands', BrandController::class);
    Route::resource('taxes', TaxController::class);
    Route::resource('holidays', HolidayController::class);
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('labels', LabelController::class);
    
    Route::post('/vendors/{vendor}/brand', [VendorController::class, 'addBrand'])->name('vendors.addBrand');
    Route::delete('/vendors/{vendor}/brand', [VendorController::class, 'removeBrand'])->name('vendors.removeBrand');
    Route::resource('vendors', VendorController::class);



    
    Route::get('/profile', [VendorController::class, 'index'])->name('profile.update');
   # Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
