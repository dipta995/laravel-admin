<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\Auth\PasswordResetLinkController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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
Route::get('/storage-shortcut', function () {
    Artisan::call('storage:link');
});
Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin'], function () {

Route::get('/login',[AuthenticatedSessionController::class,'create'])->name('admin.login');
Route::post('/login/submit',[AuthenticatedSessionController::class,'store'])->name('admin.login.submit');
Route::post('/logout/submit',[AuthenticatedSessionController::class,'destroy'])->name('admin.logout.submit');

Route::get('/password/reset',[PasswordResetLinkController::class,'create'])->name('admin.password');
Route::post('/password/reset/submit',[PasswordResetLinkController::class,'destroy'])->name('admin.password.submit');

Route::get('/',[DashboardController::class,'index'])->name('home');
Route::resource('roles', RolesController::class,['names'=>'admin.roles']);
Route::resource('admins', AdminController::class,['names'=>'admin.admins']);
Route::resource('users', UserController::class,['names'=>'admin.users']);
Route::resource('tests', \App\Http\Controllers\Backend\TestController::class,['names'=>'admin.tests']);
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
