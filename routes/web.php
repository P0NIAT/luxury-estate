<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\Backend\FacilitiesController;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');

    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');

    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');

    Route::get('/admin/password', [AdminController::class, 'AdminPassword'])->name('admin.password');

    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');

    Route::get('/type/all', [PropertyTypeController::class, 'TypeAll'])->name('type.all');

    Route::get('/type/addnew', [PropertyTypeController::class, 'TypeAddNew'])->name('type.addnew');
}); // End Group Admin Midleware


Route::middleware(['auth', 'role:agent'])->group(function () {

    Route::get('/agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
}); // End Group Agent Midleware



Route::middleware(['auth', 'role:admin'])->group(function () {

    // Property Type All Routes
    Route::controller(PropertyTypeController::class)->group(function () {

        Route::get('/type/all', 'TypeAll')->name('type.all');

        Route::get('/type/addnew', 'TypeAddNew')->name('type.addnew');

        Route::post('/type/store', 'TypeStore')->name('type.store');

        Route::get('/type/edit/{id}', 'TypeEdit')->name('type.edit');

        Route::post('/type/update', 'TypeUpdate')->name('type.update');

        Route::get('/type/delete/{id}', 'TypeDelete')->name('type.delete');
    });

    // Facilities Type All Routes
    Route::controller(FacilitiesController::class)->group(function () {

        Route::get('/facilities/all', 'FacilitiesAll')->name('facilities.all');

        Route::get('/facilities/addnew', 'FacilitiesAddNew')->name('facilities.addnew');

        Route::post('/facilities/store', 'FacilitiesStore')->name('facilities.store');

        Route::get('/facilities/edit/{id}', 'FacilitiesEdit')->name('facilities.edit');

        Route::post('/facilities/update', 'FacilitiesUpdate')->name('facilities.update');

        Route::get('/facilities/delete/{id}', 'FacilitiesDelete')->name('facilities.delete');
    });
}); // End Group for Property Facilities with Admin Midleware

// php artisan serve
// php artisan optimize
