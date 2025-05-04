<?php

use App\Http\Controllers\Admin\AdminClientsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ServiceProviderController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [PagesController::class, 'indexpage'])->name('index');
Route::get('/category-images/{slug}', [PagesController::class, 'categoryImages'])->name('category-images');
Route::get('/register-client', [PagesController::class, 'registerClient'])->name('register.client');
Route::post('/store-client', [PagesController::class, 'storeClient'])->name('register-client-account');
Route::post('/register-service-provider', [PagesController::class, 'registerServiceProvider'])->name('register-service-provider');
Route::post('/submit-booking', [PagesController::class, 'storeBookings'])->name('submit-booking');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/service-providers', [AdminController::class, 'serviceProviders'])->name('admin.providers');
    Route::get('/payments', [AdminController::class, 'getPayments'])->name('admin.payments');
    Route::get('/service-providers/create', [AdminController::class, 'createServiceProvider'])->name('admin.providers.create');
    Route::post('/service-providers/store', [AdminController::class, 'storeServiceProvider'])->name('admin.providers.store');
    Route::get('/service-providers/confirm/{slug}', [AdminController::class, 'confirmServiceProvider'])->name('admin.providers.confirm');
    Route::get('/service-providers/edit/{slug}', [AdminController::class, 'editServiceProvider'])->name('admin.providers.edit');
    Route::patch('/service-providers/update/{slug}', [AdminController::class, 'updateServiceProvider'])->name('admin.providers.update');
    Route::delete('/service-providers/destroy/{slug}', [AdminController::class, 'destroyServiceProvider'])->name('admin.providers.destroy');
    Route::delete('/providers/{provider}/image/{key}', [AdminController::class, 'deleteImage'])->name('admin.providers.deleteImage');


    Route::get('/clients-list', [AdminClientsController::class, 'allClients'])->name('admin.clients.list');
});
Route::prefix('provider')->middleware(['auth', 'role:provider'])->group(function () {
    Route::get('/dashboard', [ServiceProviderController::class, 'dashboard'])->name('provider.dashboard');
    Route::get('/bookings', [ServiceProviderController::class, 'bookings'])->name('provider.bookings');
    Route::get('/bookings/create', [ServiceProviderController::class, 'createBooking'])->name('providers.bookings.create');
    Route::post('/bookings/confirm/{slug}', [ServiceProviderController::class, 'confirmBooking'])->name('providers.bookings.confirm');
    Route::get('/services', [ServiceProviderController::class, 'services'])->name('provider.services');
    Route::get('/services/create', [ServiceProviderController::class, 'createService'])->name('providers.services.create');
    Route::post('/services/store', [ServiceProviderController::class, 'storeService'])->name('providers.services.store');
    Route::get('/services/edit/{slug}', [ServiceProviderController::class, 'editService'])->name('providers.services.edit');
    Route::patch('/services/edit/{slug}', [ServiceProviderController::class, 'updateService'])->name('provider.services.update');
    Route::delete('/services/delete/{slug}', [ServiceProviderController::class, 'deleteService'])->name('providers.services.destroy');
});
Route::prefix('client')->middleware(['auth', 'role:client'])->group(function () {
    Route::get('/dashboard', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::get('/bookings', [ClientController::class, 'bookings'])->name('client.bookings');
    Route::get('/bookings/create', [ClientController::class, 'createBookings'])->name('client.bookings.create');
    Route::post('/bookings/store', [ClientController::class, 'storeBookings'])->name('client.bookings.store');
});
