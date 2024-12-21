<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GoalController;
use App\Http\Controllers\UserController;

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
    return view('index');
});

// Route::get('/dashboard', function () {
//     return view('index');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::controller(UserController::class)->middleware(['auth'])->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::get('/admin', [UserController::class, 'admin'])->middleware(['auth', 'admin'])->name('admin');

Route::controller(GoalController::class)->middleware(['auth'])->group(function () {
    Route::patch('/goals/reset', 'resetGoalsSet')->name('resetGoalsSet');
    Route::post('/goals', 'store')->name('store');

    Route::get('/goals/create', 'create')->name('create');
    Route::patch('/goals/done/{goal}', 'done')->name('done');
    Route::patch('/goals/set/{goal}', 'set')->name('set');
    Route::get('/goals/{goal}', 'show')->name('show');
    Route::put('/goals/{goal}', 'update')->name('update');
    Route::delete('/goals/{goal}', 'delete')->name('delete');
    Route::get('/goals/{goal}/edit', 'edit')->name('edit');
});



Route::get('/admin', [App\Http\Controllers\UserController::class, 'admin'])->middleware(['auth', 'verified'])->name('admin');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
