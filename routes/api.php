<?php

use App\Http\Controllers\IssueController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::name('issue.')->group(function() {
    Route::get('/all', [IssueController::class, 'index'])->name('index');
    Route::get('/show', [IssueController::class, 'show'])->name('show');
    Route::post('/store', [IssueController::class, 'store'])->name('store');
    Route::put('/update', [IssueController::class, 'update'])->name('update');
    Route::delete('/delete', [IssueController::class, 'destroy'])->name('delete');
});

//Route::apiResources([
//    'issues' => IssueController::class
//]);
