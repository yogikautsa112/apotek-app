<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sini Anda bisa mendaftarkan rute web untuk aplikasi Anda. Rute ini
| dimuat oleh RouteServiceProvider dan semuanya akan di-assign ke
| grup middleware "web". Buat sesuatu yang hebat!
|
*/

/*
Route::httpmethod('/url', [NamaController::class, 'namaFunction'])->name('nama_route');
httpMethod : 
- get    -> mengambil data
- post   -> menambah data
- patch  -> memperbarui sebagian data
- put    -> memperbarui data sepenuhnya
- delete -> menghapus data
URL dan name() harus unik
*/

// Route untuk login
Route::get('/', [UserController::class, 'loginPage'])->name('login');
Route::post('/actionLogin', [UserController::class, 'login'])->name('actionLogin');
Route::get('/logout', action: [UserController::class, 'logout'])->name( 'logout');

// Route untuk landing page
Route::get('/landing-page', [LandingPageController::class, 'index'])->name(name: 'landing_page');
// Route home (juga menggunakan MedicineController)
Route::get('/home', [UserController::class, 'home'])->name('home');

// Route untuk medicines
Route::get('/medicines', [MedicineController::class, 'index'])->name('medicines');
Route::get('/medicine/add', [MedicineController::class, 'create'])->name('medicines.add');
Route::post('/medicine/add', [MedicineController::class, 'store'])->name('medicines.add.store');
Route::get('/medicine/edit/{id}', [MedicineController::class, 'edit'])->name('medicines.edit');
Route::patch('/medicine/edit/{id}', [MedicineController::class, 'update'])->name('medicines.edit.update');
Route::delete('/medicine/delete/{id}', [MedicineController::class, 'destroy'])->name('medicines.delete');

// Route untuk meng-update stok medicine
Route::put('/medicines/update-stock/{id}', [MedicineController::class, 'stockEdit'])->name('medicines.update-stock');

// Route untuk user management
Route::get('/menage', [UserController::class, 'index'])->name('menage');
Route::get('/user-add', [UserController::class, 'create'])->name('user_add');
Route::post('/user-add', [UserController::class, 'store'])->name('user_add.store');
Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('users.edit');
Route::patch('/user-edit/{id}', [UserController::class, 'update'])->name('users.edit.update');
Route::delete('/user-delete/{id}', [UserController::class, 'destroy'])->name('users.delete');