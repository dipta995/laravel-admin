<?php

use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Backend\Auth\PasswordResetLinkController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DemoController;
use App\Http\Controllers\Backend\RolesController;
use App\Http\Controllers\Backend\TestController;
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
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
Route::get('/login',[AuthenticatedSessionController::class,'create'])->name('login');
Route::post('/login/submit',[AuthenticatedSessionController::class,'store'])->name('login.submit');
Route::post('/logout/submit',[AuthenticatedSessionController::class,'destroy'])->name('logout.submit');

Route::get('/password/reset',[PasswordResetLinkController::class,'create'])->name('password');
Route::post('/password/reset/submit',[PasswordResetLinkController::class,'destroy'])->name('password.submit');
});
Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => 'auth:admin'], function () {

Route::get('/',[DashboardController::class,'index'])->name('home');
Route::resource('roles', RolesController::class,['names'=>'roles']);
Route::resource('admins', AdminController::class,['names'=>'admins']);
Route::resource('users', UserController::class,['names'=>'users']);
Route::resource('tests', TestController::class,['names'=>'tests']);
Route::post('/test/update/{id}',[TestController::class,'update'])->name('updatetest');
Route::resource('demos', DemoController::class,['names'=>'demos']);
//Route::post('/demo/update/{id}',[DemoController::class,'update'])->name('updatedemo');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
