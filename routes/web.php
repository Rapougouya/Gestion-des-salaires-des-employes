<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\ConfigurationController;

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'handlelogin'])->name('handlelogin');

Route::post('/logout', [AuthController::class,'logout'])->name('logout');

//Route securisé


Route::middleware('auth')->group(function(){
 Route::get('dashboard', [AppController::class, 'index'])->name('dashboard');  
 Route::prefix('employers')->group(function(){
    Route::get('/',  [EmployerController::class, 'index'])->name('employer.index');
    Route::get('/create',  [EmployerController::class, 'create'])->name('employer.create');
    Route::get('/edit/{employer}',  [EmployerController::class, 'edit'])->name('employer.edit');

    //Route d'actions
    Route::put('/update/{employer}',  [EmployerController::class, 'update'])->name('employer.update');

    Route::post('/store',  [EmployerController::class, 'store'])->name('employer.store');
    Route::get('/delete/{employer}',  [EmployerController::class, 'delete'])->name('employer.delete');
});

Route::prefix('departements')->group(function(){
    Route::get('/',  [DepartementController::class, 'index'])->name('departement.index');
    Route::get('/create',  [DepartementController::class, 'create'])->name('departement.create');
    Route::post('/create',  [DepartementController::class, 'store'])->name('departement.store');

    


    Route::get('/edit/{departement}',  [DepartementController::class, 'edit'])->name('departement.edit');
    Route::put('/update/{departement}',  [DepartementController::class, 'update'])->name('departement.update');
    Route::get('/delete/{departement}',  [DepartementController::class, 'delete'])->name('departement.delete');
});

Route::prefix('configurations')->group(function(){
    Route::get('/',  [ConfigurationController::class, 'index'])->name('configurations');
    Route::get('/create',  [ConfigurationController::class, 'create'])->name('configuration.create');

    //Routes d'actions
    Route::post('/store',   [ConfigurationController::class, 'store'])->name('configuration.store');
    Route::get('/delete/{configuration}',  [ConfigurationController::class, 'delete'])->name('configuration.delete');
});

Route::prefix('administrateurs')->group(function(){
    Route::get('/',  [AdminController::class, 'index'])->name('administrateurs');
    Route::get('/create',  [AdminController::class, 'create'])->name('administrateurs.create');
    Route::get('/edit/{administrateur}',  [AdminController::class, 'edit'])->name('administrateurs.edit');
    Route::put('/update/{administrateur}',  [AdminController::class, 'update'])->name('administrateurs.update');

    //Routes d'actions
    Route::post('/create',   [AdminController::class, 'store'])->name('administrateurs.store');
    Route::get('/delete/{user}',  [AdminController::class, 'delete'])->name('administrateurs.delete');

    Route::get('/validate-account/{email}', [AdminController::class, 'defineAccess'])->name('defineAccess');
    Route::post('/validate-account/{email}', [AdminController::class, 'submitDefineAccess'])->name('submitDefineAccess');
});

Route::prefix('paiement')->group(function(){
    Route::get('/',  [PaiementController::class, 'index'])->name('paiements');
    Route::get('/init',  [PaiementController::class, 'initPayment'])->name('paiements.init');
    Route::get('/download-invoice/{paiement}',  [PaiementController::class, 'downloadInvoice'])->name('paiement.download');

});
});