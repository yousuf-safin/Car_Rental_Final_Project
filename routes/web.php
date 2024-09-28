<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\RentalController as AdminRentalController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\RentalController as FrontendRentalController;
use App\Http\Controllers\MyRentals;
use App\Http\Controllers\ProfileController;
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

Route::get( '/', [PageController::class, 'home'] )->name( 'homepage' );
Route::get( '/about', [PageController::class, 'about'] )->name( 'about' );
Route::get( '/rentals', [FrontendRentalController::class, 'index'] )->name( 'frontedrentals' );
Route::get( '/contact', [PageController::class, 'contact'] )->name( 'contact' );

Route::middleware( ['auth', 'customer'] )->group( function () {
    Route::get( '/user/rentals', [AdminRentalController::class, 'index'] );
    Route::post( '/user/rentals', [AdminRentalController::class, 'store'] );
} );

Route::middleware( 'auth' )->group( function () {
    Route::get( '/profile', [ProfileController::class, 'edit'] )->name( 'profile.edit' );
    Route::patch( '/profile', [ProfileController::class, 'update'] )->name( 'profile.update' );
    Route::delete( '/profile', [ProfileController::class, 'destroy'] )->name( 'profile.destroy' );
    Route::get( '/rentals/{car}/create', [FrontendRentalController::class, 'create'] )->name( 'frontedrentals.create' );
    Route::post( '/rentals', [FrontendRentalController::class, 'store'] )->name( 'frontedrentals.store' );
    Route::get( '/myrentals', [MyRentals::class, 'index'] )->name( 'myrentals' );
    Route::patch( '/rentals/{id}/cancel', [FrontendRentalController::class, 'cancel'] )->name( 'rentals.cancel' );
} );

// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
//     Route::resource('/admin/cars', CarController::class);
//     Route::resource('/admin/rentals', AdminRentalController::class);
//     Route::resource('/admin/customers', CustomerController::class);
// });

Route::middleware( ['auth', 'admin'] )->group( function () {
    Route::get( '/admin/dashboard', [AdminDashboardController::class, 'index'] )->name( 'admin.dashboard' );
    Route::resource( '/admin/cars', CarController::class );
    Route::resource( '/admin/rentals', AdminRentalController::class );
    Route::resource( '/admin/customers', CustomerController::class );
    Route::get( '/admin/customers/{id}/history', [CustomerController::class, 'history'] )->name( 'admin.customers.history' );
} );

require __DIR__ . '/auth.php';