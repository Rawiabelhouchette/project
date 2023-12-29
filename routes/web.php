<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\AubergeController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BarController;
use App\Http\Controllers\BoiteDeNuitController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FastFoodController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LocationMeubleeController;
use App\Http\Controllers\LocationVehiculeController;
use App\Http\Controllers\PatisserieController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\publicController;
use App\Http\Controllers\QuartierController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\searchController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VilleController;
use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('login');//->name('login');
})->name('connexion');

Route::get('/', [publicController::class, 'home'])->name('accueil');
Route::get('/entreprise/{slug}', [publicController::class, 'showEntreprise'])->name('entreprise.show');
Route::get('/search', [searchController::class, 'search'])->name('search');
Route::get('/search/{slug}', [searchController::class, 'show'])->name('show');
// /search?key=&type=
Route::get('/search?key={key}&type={type}', [searchController::class, 'search'])->name('search.key.type');


// Admin 

Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

// Auth middleware
Route::group([
    'middleware' => 'App\Http\Middleware\Auth',
], function () {

    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::prefix('staff')->middleware('App\Http\Middleware\Admin')->group(function () {

        Route::get('dashboard', [AdminController::class, 'home'])->name('home');

        // Une route de ressource pour les références
        Route::resource('references', ReferenceController::class);
        Route::get('references/nom/add', [ReferenceController::class, 'create_name'])->name('references.nom.add');
        Route::get('references/nom/datatable', [ReferenceController::class, 'getNameDataTable'])->name('references.nom.datatable');
        Route::get('references/ref/datatable', [ReferenceController::class, 'getDataTable'])->name('references.datatable');
        Route::post('references/nom/post', [ReferenceController::class, 'store_name'])->name('references.nom.post');
        Route::get('references/nom/{type}', [ReferenceController::class, 'get_name'])->name('references.nom.get');

        Route::resource('pays', PaysController::class);

        Route::resource('villes', VilleController::class);
        
        Route::resource('quartiers', QuartierController::class);
        Route::get('localisations', [QuartierController::class, 'localisation'])->name('localisations');

        Route::resource('users', UserController::class);
        Route::get('users/list/datatable', [UserController::class, 'getDataTable'])->name('users.datatable');

        Route::resource('entreprises', EntrepriseController::class);

        Route::resource('annonces', AnnonceController::class);
        Route::get('annonces/list/datatable', [AnnonceController::class, 'getDataTable'])->name('annonces.datatable');

        Route::resource('auberges', AubergeController::class);

        Route::resource('hotels', HotelController::class);

        Route::resource('location-vehicules', LocationVehiculeController::class);

        Route::resource('location-meublees', LocationMeubleeController::class);

        Route::resource('boite-de-nuits', BoiteDeNuitController::class);

        Route::resource('fast-foods', FastFoodController::class);

        Route::resource('restaurants', RestaurantController::class);

        Route::resource('bars', BarController::class);

        Route::resource('patissieries', PatisserieController::class);
    });

    // TODO: Route for 404, 403, 500, 503, etc


});


