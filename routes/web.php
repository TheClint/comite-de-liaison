<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ComiteController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartementController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/departement/{departement}', [DepartementController::class, 'show'])->middleware(['auth', 'verified']);
Route::resource('comite', ComiteController::class)->middleware(['auth', 'verified']);
Route::get('/comite/create/{localite}/{id}', [ComiteController::class, 'create'])->middleware(['auth', 'verified']);
Route::get('/comite/create/national', [ComiteController::class, 'create'])->middleware(['auth', 'verified']);

Route::resource('demande', DemandeController::class)->middleware(['auth', 'verified']);
Route::controller(DemandeController::class)->group(function () {
    Route::get('/demande/editReferencer/{demande}', 'editReferencer')->name('demande.editReferencer');
    Route::post('/demande/referencer/{demande}', 'referencer')->name('demande.referencer');
})->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
