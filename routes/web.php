<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;

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


Route::get('home', [EventController::class, 'event'])->name('home'); 

Route::get('paypal', [EventController::class, 'getPaymentStatus'])->name('status'); 

Route::get('/', function () {
    return redirect()->route('login');
});



Route::get('dashboard.index', [AdminController::class, 'dashboard'])->name('dashboard'); 
Route::get('login', [AdminController::class, 'index'])->name('login');
Route::post('admin-login', [AdminController::class, 'adminLogin'])->name('login.custom'); 
Route::get('registration', [AdminController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AdminController::class, 'customRegistration'])->name('register.custom'); 
Route::get('signout', [AdminController::class, 'signOut'])->name('signout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.index');
    Route::resource('events', EventController::class);
});

Route::post('event-attendies', [EventController::class, 'eventAttendies'])->name('event-attendies');
