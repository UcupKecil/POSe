<?php


use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\KategoriController;
// use App\Http\Controllers\KategoriBeritaController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SuplierController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


//require_once('includes/kategori.php');
require_once('includes/kategoriberita.php');

Route::get('/', function () {
    return redirect('/admin');
});

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::resource('products', ProductController::class);

    Route::get('students', [StudentController::class, 'index']);
    Route::get('students/list', [StudentController::class, 'getStudents'])->name('students.list');

    Route::get('kategoris', [KategoriController::class, 'index']);
    Route::post('kategoris', [KategoriController::class, 'tambah'])->name('kategoris.tambah');
    Route::post('delete-kategoris', [KategoriController::class,'destroy']);
    Route::get('kategoris/list', [KategoriController::class, 'getKategoris'])->name('kategoris.list');
    Route::resource('kategoris', KategoriController::class);
    // Route::get('/kategoriberita', [KategoriBeritaController::class, 'index']);

    Route::get('supliers', [SuplierController::class, 'index']);
    Route::get('supliers/list', [SuplierController::class, 'getSupliers'])->name('supliers.list');
    Route::resource('supliers', SuplierController::class);
    Route::post('supliers', [SuplierController::class, 'store'])->name('supliers.store');

    Route::resource('customers', CustomerController::class);
    Route::resource('orders', OrderController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);
});


