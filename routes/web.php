<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// Admin controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\TechnologyController;

// Guest controller
use App\Http\Controllers\Guest\PageController;




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

Route::get('/', [PageController::class, 'index'])->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function(){
        Route::get('/', [DashboardController::class, 'index'])->name('home');
        Route::get('types/items-types',[TypeController::class, 'itemsTypes'])->name('itemsTypes');
        Route::delete('items/delete-img/{item}',[ItemController::class, 'deleteImg'])->name('deleteImg');
        Route::resource('items', ItemController::class);
        Route::resource('types', TypeController::class);
        Route::resource('techs', TechnologyController::class);

    });

require __DIR__.'/auth.php';
