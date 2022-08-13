<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\SectorController;
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

Route::get('/', [FormController::class, 'index']);
Route::post('/submit-sector', [FormController::class, 'insertUserSector'])->name('submit-form');


Route::get('/add-sector', [SectorController::class, 'index']);
Route::post('/submit-sector', [SectorController::class, 'insertSector'])->name('submit-sector');
