<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ElecteurController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\Admin\ProgrammeController;



// Route::get('/', function () {
//     return view('welcome');
// });


// Route pour afficher le formulaire de connexion
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Route pour traiter le formulaire de connexion
Route::post('/', [AuthController::class, 'login']);


// Route pour afficher le formulaire d'inscription
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');

// Route pour traiter le formulaire d'inscription
Route::post('/register', [AuthController::class, 'register']);


//Routes pour les electeurs(Les users)

Route::get('/candidats/{id}', [ElecteurController::class, 'detailsCandidat'])->name('electeur.detailsCandidat');
Route::get('/candidats/{id}', [ElecteurController::class, 'detailsCandidat'])->name('electeur.detailsCandidat');
Route::get('/programmes/{id}', [ElecteurController::class, 'detailsProgramme'])->name('electeur.detailsProgramme');
Route::post('/programmes/{id}/like', [ProgrammeController::class, 'likeProgramme'])->name('programmes.like');
Route::post('/programmes/{id}/like', [ElecteurController::class, 'likeProgramme'])->name('electeur.likeProgramme');

Route::get('/electeur', [ElecteurController::class, 'index'])->name('electeur');
Route::get('/admin-dashboard', [ElecteurController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/user-dashboard', [ELecteurController::class, 'visualiserCandidats'])->name('user.dashboard');
Route::get('/candidats', [ELecteurController::class, 'visualiserCandidats'])->name('electeur.visualiserCandidats');


//Route pour les candidats

Route::get('/candidats', [CandidatController::class, 'index'])->name('admin.candidats');
Route::get('/add', [CandidatController::class, 'add'])->name('admin.candidats.add');
Route::post('/store', [CandidatController::class, 'store'])->name('admin.candidats.store');
Route::get('/edit/{id}', [CandidatController::class, 'edit'])->name('admin.candidats.edit');
Route::put('/update/{id}', [CandidatController::class, 'update'])->name('admin.candidats.update');
Route::delete('/destroy/{id}', [CandidatController::class, 'destroy'])->name('admin.candidats.destroy');



//  // Routes pour les programmes
//  Route::get('/programmes', [ProgrammeController::class, 'index'])->name('admin.programmes.add');
//  Route::get('/programmes/add', [ProgrammeController::class, 'add'])->name('admin.programmes.create');
//  Route::post('/programmes/store', [ProgrammeController::class, 'store'])->name('admin.programmes.store');
//  Route::get('/programmes/edit/{id}', [ProgrammeController::class, 'edit'])->name('admin.programmes.edit');
//  Route::put('/programmes/update/{id}', [ProgrammeController::class, 'update'])->name('admin.programmes.update');
//  Route::delete('/programmes/destroy/{id}', [ProgrammeController::class, 'destroy'])->name('admin.programmes.destroy');





    Route::get('/admin/programmes', [ProgrammeController::class, 'index'])->name('admin.programmes.index');
    Route::get('/addprogramme', [ProgrammeController::class, 'add'])->name('admin.programmes.add');
    Route::get('/admin/programmes/create', [ProgrammeController::class, 'create'])->name('admin.programmes.create');
    Route::post('/admin/programmes', [ProgrammeController::class, 'store'])->name('admin.programmes.store');
    Route::get('/admin/programmes/{programme}', [ProgrammeController::class, 'show'])->name('admin.programmes.show');
    Route::get('/admin/programmes/{programme}/edit', [ProgrammeController::class, 'edit'])->name('admin.programmes.edit');
    Route::put('/admin/programmes/{programme}', [ProgrammeController::class, 'update'])->name('admin.programmes.update');
    Route::delete('/admin/programmes/{programme}', [ProgrammeController::class, 'destroy'])->name('admin.programmes.destroy');
