<?php

use App\Http\Controllers\ProfileController;
use Google\ApiCore\RequestBuilder;
use Illuminate\Support\Facades\Route;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

use App\Http\Controllers\ZdezController;
use App\Http\Controllers\PDFController;

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




Route::get('/dashboard', [ZdezController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::post('/generate-pdf', [PDFController::class, 'generatePDF']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard/report/{a?}', [ZdezController::class, 'show'])->middleware(['auth', 'verified'])->name('report_dashboard');

    Route::get('/dashboard/download/{a?}', [ZdezController::class, 'download'])->middleware(['auth', 'verified'])->name('download_dashboard');
});

require __DIR__ . '/auth.php';
