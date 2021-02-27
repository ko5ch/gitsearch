<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RepositoryController;
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
    return redirect()->route('repositories.search');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
Route::group([ 'middleware' => ['web', 'auth']], function () {
    Route::group(['prefix' => 'git-repositories', 'as' => 'repositories.'],  function() {
        Route::delete('{favorite:repo_id}', [RepositoryController::class, 'delete'])->name('delete');
        Route::get('', [RepositoryController::class, 'index'])->name('search');
        Route::post('', [RepositoryController::class, 'store'])->name('store');
    });
    Route::get('favorites', [RepositoryController::class, 'favorites'])->name('repositories.favorites');
});
require __DIR__.'/auth.php';
