<?php
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LowQuantityController;
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

Route::get('/', function () {
    return view('welcome');
})->name("auth.login");
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified',])->name('dashboard');
Route::get('/login', function () {
    return view('auth.register')->name('register');
})->name("home");
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('articles', ArticleController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('category',CategoryController::class);
    Route::resource('lowquantity',LowQuantityController::class);
});
Route::get('/alertStock', [LowQuantityController::class, 'index'])->name('alert.index');



require __DIR__.'/auth.php';


