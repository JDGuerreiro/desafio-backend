<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
        MainController,
        PaymentMethodsController,
        FeesSetupController,
        QuoteController
    };

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('payment_fees', FeesSetupController::class, ['names'=>['index'=>'payment_fees']]);

Route::resource('payment_methods', PaymentMethodsController::class, ['names'=>['index'=>'payment_methods']]);

Route::get('/dashboard', [QuoteController::class, 'QuoteForm'])->middleware(['auth'])->name('dashboard');

Route::post('/dashboard', [QuoteController::class, 'QuoteFormPost'])->middleware(['auth'])->name('quote_exchange_trade_post');

Route::get('/history', [QuoteController::class, 'history'])->middleware(['auth'])->name('history');

require __DIR__.'/auth.php';

