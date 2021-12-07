<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\RatingsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController;


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
Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localize' ]], function () {
Route::get('/',[HomeController::class,'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::prefix('admin')

    ->group(function (){
        Route::group([
            'prefix'=>'/categories',
            'as'=>'categories.'
        ],function (){
            Route::get('/',[CategoriesController::class,'index'])->name('index');
            Route::get('/create',[CategoriesController::class,'create'])->name('create');
            Route::post('/',[CategoriesController::class,'store'])->name('store');
            Route::get('/{category }',[CategoriesController::class,'show'])->name('show');
            Route::get('/{id}/edit',[CategoriesController::class,'edit'])->name('edit');
            Route::put('/{id}',[CategoriesController::class,'update'])->name('update');
            Route::delete('/{id}',[CategoriesController::class,'destroy'])->name('destroy');
        }
        );

        Route::get('/products/trash',[ProductsController::class,'trash'])
            ->name('products.trash');
        Route::put('/products/trash/{id?}',[ProductsController::class,'restore'])
            ->name('products.restore');
        Route::delete('/products/trash/{id?}',[ProductsController::class,'forceDelete'])
            ->name('products.forceDelete');

        Route::resource('/products','Admin\ProductsController');
        Route::resource('/countries','Admin\CountriesController');
    });

Route::post('/ratings/{$type}',[RatingsController::class,'store']);


});
//Route::get(  , 'ProductsController@index')->name('products');
Route::get('product/{slug}', [ProductsController::class,'show'])->name('product.details');



Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart', [CartController::class, 'store']);
