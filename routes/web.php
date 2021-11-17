<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;

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

Auth::routes();
Route::redirect('/home', '/admin/dashboard');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard')->middleware('is_super_admin');
/*
 * Route for user module
 */
Route::get('user/dashboard', [HomeController::class, 'index'])->name('user.dashboard')->middleware('is_user');
Route::get('sales/dashboard', [HomeController::class, 'dashboard'])->name('sales.dashboard')->middleware('is_sales_manager');
Route::get('user/list', [\App\Http\Controllers\UserController::class, 'index'])->name('users.list')->middleware('is_sales_manager');
Route::get('users', [\App\Http\Controllers\UserController::class, 'getDataTable'])->name('users.listing')->middleware('is_sales_manager');
Route::get('users/datatable', [\App\Http\Controllers\UserController::class, 'getUserData'])->name('users.list')->middleware('is_super_admin');
Route::post('users/destroy/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy')->middleware('is_super_admin');
Route::get('users/edit/{id}', [\App\Http\Controllers\UserController::class, 'edit'])->name('users.edit')->middleware('is_super_admin');
Route::post('users/update/{id}', [\App\Http\Controllers\UserController::class, 'update'])->name('users.update')->middleware('is_super_admin');

Route::get('user/export', [\App\Http\Controllers\UserController::class, 'export'])->name('user.export')->middleware('is_super_admin');

Route::get('verify/resend', '\App\Http\Controllers\Auth\TwoFactorController@resend')->name('verify.resend');
Route::resource('verify', '\App\Http\Controllers\Auth\TwoFactorController')->only(['index', 'store']);


Route::get('claims/create', [\App\Http\Controllers\ClaimsController::class, 'create'])->name('create.claim')->middleware('is_super_admin');
Route::post('claims/save', [\App\Http\Controllers\ClaimsController::class, 'store'])->name('save.claim')->middleware('is_super_admin');
Route::get('claims', [\App\Http\Controllers\ClaimsController::class, 'index'])->name('claim.listing')->middleware('is_super_admin');
Route::get('claims/datatable', [\App\Http\Controllers\ClaimsController::class, 'getClaimsData'])->name('claim.list')->middleware('is_super_admin');
Route::get('claims/edit/{id}', [\App\Http\Controllers\ClaimsController::class, 'edit'])->name('edit.claim')->middleware('is_super_admin');
Route::post('claims/update/{id}', [\App\Http\Controllers\ClaimsController::class, 'update'])->name('update.claim')->middleware('is_super_admin');
