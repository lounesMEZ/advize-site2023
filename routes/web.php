<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InscriptionController;

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

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/home', [UserController::class, 'index'])->name('home');

Route::get('/register', [InscriptionController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [InscriptionController::class, 'register'])->name('register.submit');

Route::get('/inscription', [InscriptionController::class, 'showRegistrationForm'])->name('register.form');

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/form/{id?}', [UserController::class, 'userForm'])->name('users.form');
Route::put('/users/form/{id?}', [UserController::class, 'saveUser'])->name('users.save');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users/store', [UserController::class, 'saveUser'])->name('users.store');
Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
