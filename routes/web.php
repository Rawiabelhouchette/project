<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnonceController;
use App\Http\Controllers\AubergeController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BarController;
use App\Http\Controllers\BoiteDeNuitController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\FastFoodController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LocationMeubleeController;
use App\Http\Controllers\LocationVehiculeController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PatisserieController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\Public\Annonce\AubergeController as PublicAubergeController;
use App\Http\Controllers\Public\Annonce\BarController as PublicBarController;
use App\Http\Controllers\Public\Annonce\BoiteDeNuitController as PublicBoiteDeNuitController;
use App\Http\Controllers\Public\Annonce\FastFoodController as PublicFastFoodController;
use App\Http\Controllers\Public\Annonce\HotelController as PublicHotelController;
use App\Http\Controllers\Public\Annonce\LocationMeubleeController as PublicLocationMeubleeController;
use App\Http\Controllers\Public\Annonce\LocationVehiculeController as PublicLocationVehiculeController;
use App\Http\Controllers\Public\Annonce\PatisserieController as PublicPatisserieController;
use App\Http\Controllers\Public\Annonce\RestaurantController as PublicRestaurantController;
use App\Http\Controllers\Public\AnnonceController as PublicAnnonceController;
use App\Http\Controllers\Public\UserController as PublicUserController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\QuartierController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VilleController;
use App\Services\Paiement\PaiementService;
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
    if (auth()->check()) {
        return redirect('/');
    }

    return view('login');
})->name('connexion');

Route::get('/register', function () {
    if (auth()->check()) {
        return redirect('/');
    }

    return view('register');
})->name('register');

Route::get('/', [PublicController::class, 'home'])->name('accueil');
Route::get('contact', [AccountController::class, 'contact'])->name('contact');
Route::post('contact-us', [AccountController::class, 'contactUs'])->name('contact-us');
Route::get('entreprise/{slug}', [PublicController::class, 'showEntreprise'])->name('entreprise.show');
Route::get('search', [SearchController::class, 'search'])->name('search');
Route::get('search/{slug}', [SearchController::class, 'show'])->name('show');
Route::get('search?key={key}&type={type}', [SearchController::class, 'search'])->name('search.key.type');

Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::get('password/reset', [AuthenticationController::class, 'reset'])->name('password.reset');

Route::post('password-link', [AccountController::class, 'resetPassword'])->name('password.reset.post');

Route::get('notification/reset-password', [AccountController::class, 'notificationSuccess'])->name('notification.rest-password.success');
Route::post('reset-password', [AccountController::class, 'newPassword'])->name('password.update');

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Auth middleware
Route::group(['middleware' => 'App\Http\Middleware\Auth'], function () {

    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::prefix('staff')->group(function () {
        Route::middleware('App\Http\Middleware\Admin')->group(function () {
            // Une route de ressource pour les références
            Route::resource('references', ReferenceController::class)->except(['create']);
            Route::get('references/nom/add', [ReferenceController::class, 'create_name'])->name('references.nom.add');
            Route::get('references/nom/datatable', [ReferenceController::class, 'getNameDataTable'])->name('references.nom.datatable');
            Route::get('references/ref/datatable', [ReferenceController::class, 'getDataTable'])->name('references.datatable');
            Route::post('references/nom/post', [ReferenceController::class, 'store_name'])->name('references.nom.post');
            Route::get('references/nom/{type}', [ReferenceController::class, 'get_name'])->name('references.nom.get');

            Route::resource('pays', PaysController::class)->only(['index']);
            Route::get('pays/list/datatable', [PaysController::class, 'getDataTable'])->name('pays.datatable');

            Route::resource('villes', VilleController::class)->only(['index']);
            Route::get('villes/list/datatable', [VilleController::class, 'getDataTable'])->name('villes.datatable');

            Route::resource('quartiers', QuartierController::class)->only(['index']);
            Route::get('quartiers/list/datatable', [QuartierController::class, 'getDataTable'])->name('quartiers.datatable');

            Route::resource('marques', MarqueController::class)->only(['index']);
            Route::get('marques/list/datatable', [MarqueController::class, 'getDataTable'])->name('marques.datatable');

            Route::resource('modeles', ModeleController::class)->only(['index']);
            Route::get('modeles/list/datatable', [ModeleController::class, 'getDataTable'])->name('modeles.datatable');

            // Route::get('localisations', [QuartierController::class, 'localisation'])->name('localisations');

            Route::resource('users', UserController::class);
            Route::get('users/list/datatable', [UserController::class, 'getDataTable'])->name('users.datatable');

            // Route::middleware('App\Http\Middleware\Professionnel')->group(function () {

            Route::resource('entreprises', EntrepriseController::class);

            Route::resource('annonces', AnnonceController::class);
            Route::get('annonces/list/datatable', [AnnonceController::class, 'getDataTable'])->name('annonces.datatable');

            Route::resource('auberges', AubergeController::class)->only(['show']);

            Route::resource('hotels', HotelController::class)->only(['show']);

            Route::resource('location-vehicules', LocationVehiculeController::class)->only(['show']);

            Route::resource('location-meublees', LocationMeubleeController::class)->only(['show']);

            Route::resource('boite-de-nuits', BoiteDeNuitController::class)->only(['show']);

            Route::resource('fast-foods', FastFoodController::class)->only(['show']);

            Route::resource('restaurants', RestaurantController::class)->only(['show']);

            Route::resource('bars', BarController::class)->only(['show']);

            Route::resource('patisseries', PatisserieController::class)->parameters(['patisseries' => 'patisserie'])->only(['show']);

            Route::resource('abonnements', AbonnementController::class);
            Route::get('abonnements/list/datatable', [AbonnementController::class, 'getDataTable'])->name('abonnements.datatable');

            Route::resource('subscriptions', SubscriptionController::class);
            Route::get('subscriptions/list/datatable', [AbonnementController::class, 'getDataTable'])->name('subscription.datatable');

            // });

        });

        Route::get('dashboard', [AdminController::class, 'home'])->name('home');

        Route::get('accounts', [AccountController::class, 'index'])->name('accounts.index');
        Route::get('favorites', [AccountController::class, 'indexFavoris'])->name('accounts.favorite.index');
        Route::get('comments', [AccountController::class, 'indexComment'])->name('accounts.comment.index');

    });

    // Les Routes pour les professionnels
    Route::middleware('App\Http\Middleware\Professionnel')->group(function () {
        // Partie publique
        Route::get('adverts/new', [PublicAnnonceController::class, 'createAnnonce'])->name('public.annonces.create');

        Route::get('adverts/hostel/new', [PublicController::class, 'createHostel'])->name('public.hostels.create');

        Route::resource('adverts/hostels', PublicAubergeController::class, [
            'names' => [
                'create' => 'public.hostels.create',
                'edit' => 'public.hostels.edit',
            ],
        ]);

        Route::resource('adverts/hotels', PublicHotelController::class, [
            'names' => [
                'create' => 'public.hotels.create',
                'edit' => 'public.hotels.edit',
            ],
        ]);

        Route::resource('adverts/vehicle-rentals', PublicLocationVehiculeController::class, [
            'names' => [
                'create' => 'public.vehicle-rentals.create',
                'edit' => 'public.vehicle-rentals.edit',
            ],
        ]);

        Route::resource('adverts/furnished-rentals', PublicLocationMeubleeController::class, [
            'names' => [
                'create' => 'public.furnished-rentals.create',
                'edit' => 'public.furnished-rentals.edit',
            ],
        ]);

        Route::resource('adverts/night-clubs', PublicBoiteDeNuitController::class, [
            'names' => [
                'create' => 'public.night-clubs.create',
                'edit' => 'public.night-clubs.edit',
            ],
        ]);

        Route::resource('adverts/fast-foods', PublicFastFoodController::class, [
            'names' => [
                'create' => 'public.fast-foods.create',
                'edit' => 'public.fast-foods.edit',
            ],
        ]);

        Route::resource('adverts/restaurants', PublicRestaurantController::class, [
            'names' => [
                'create' => 'public.restaurants.create',
                'edit' => 'public.restaurants.edit',
            ],
        ]);

        Route::resource('adverts/bars', PublicBarController::class, [
            'names' => [
                'create' => 'public.bars.create',
                'edit' => 'public.bars.edit',
            ],
        ]);

        Route::resource('adverts/pastry-shops', PublicPatisserieController::class, [
            'names' => [
                'create' => 'public.pastry-shops.create',
                'edit' => 'public.pastry-shops.edit',
            ],
        ]);

        // annonces
        Route::get('adverts', [PublicAnnonceController::class, 'listAnnonces'])->name('public.annonces.list');

        // Mon entreprise
        Route::get('business', [PublicUserController::class, 'myBusiness'])->name('public.my-business');
        Route::get('business/edit', [PublicUserController::class, 'editMyBusiness'])->name('public.my-business.edit');

        // Abonnement
        Route::get('subscription', [PublicUserController::class, 'mySubscriptions'])->name('public.my-subscription');
    });

    // Mon compte
    Route::get('accounts', [PublicUserController::class, 'myAccount'])->name('public.my-account');

    // Mes commentaires
    Route::get('comments', [PublicUserController::class, 'myComments'])->name('public.my-comments');

    // Mes favoris
    Route::get('favorites', [PublicUserController::class, 'myFavorites'])->name('public.my-favorites');

    Route::get('pricing', [AbonnementController::class, 'choiceIndex'])->name('pricing');
    Route::get('business/create', [AbonnementController::class, 'createCompany'])->name('pricing-2');

    Route::post('abonnements/payment/check', [AbonnementController::class, 'checkPayment'])->name('abonnements.payement.check');

    Route::resource('payments', PaiementController::class);
});

// route for 404
Route::get('404', function () {
    return view('errors.404');
})->name('404');

// route for 500
Route::get('500', function () {
    return view('errors.500');
})->name('500');

// Redirection after payment
Route::get('/payment/return', [PaiementService::class, 'redirectionAfterPayment'])->name('payment.redirection');

Route::get('liens-utiles', [PublicController::class, 'liensUtiles'])->name('liens-utiles');

// Route::get('/test', function () {
//     // return route('payment.notification');
//     // send a mail
//     Mail::to('billali.sonhouin@numrod.fr')->send(new App\Mail\SubscriptionConfirmation('Billal', 'Abonnement', '01/01/2021', '01/01/2022', 'SIMTOGO'));

//     Mail::to('billali.sonhouin@numrod.fr')->send(new App\Mail\RegisterConfirmation(\App\Models\User::first()));

//     Mail::to('billali.sonhouin@numrod.fr')->send(new App\Mail\PasswordReset(\App\Models\User::first(), 'http://localhost:8000/reset-password?token=123456'));

//     Mail::to('billali.sonhouin@numrod.fr')->send(new App\Mail\ReSubscriptionConfirmation('Billal', '01/01/2021', '01/01/2022', 'SIMTOGO'));
// });

// Route::get('/test-notification', function () {
//     $user = \App\Models\User::first(); // Get the first user as an example
//     $user->notify(new ResetPassword('token123')); // Replace 'token123' with your actual token
// });



