<?php

use App\Http\Livewire\GhUser\GhUserCreate;
use App\Http\Livewire\GhUser\GhUserEdit;
use App\Http\Livewire\GhUser\GhUserList;
use App\Http\Livewire\GhUser\GhUserShow;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    
    Route::prefix('usuariosgit')->name('gh_users.')->group(function(){
        Route::get('/', GhUserList::class)->name('index');
        Route::get('/create', GhUserCreate::class)->name('create');
        Route::get('/edit/{gh_user}', GhUserEdit::class)->name('edit');
        Route::get('/delete/{gh_user}', GhUserList::class)->name('delete');
        Route::get('/show/{gh_user}', GhUserShow::class)->name('show');
    });
    
});
