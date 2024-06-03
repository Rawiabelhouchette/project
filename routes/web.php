<?php

use App\Http\Controllers\AbonnementController;
use App\Http\Controllers\AccountController;
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
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PatisserieController;
use App\Http\Controllers\PaysController;
use App\Http\Controllers\publicController;
use App\Http\Controllers\QuartierController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\searchController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VilleController;
use App\Models\Abonnement;
use App\Notifications\ResetPassword;
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
        // return back();
        return redirect('/');
    }
    return view('login');
})->name('connexion');

Route::get('/', [publicController::class, 'home'])->name('accueil');
Route::get('contact', [AccountController::class, 'contact'])->name('accounts.contact');
Route::get('entreprise/{slug}', [publicController::class, 'showEntreprise'])->name('entreprise.show');
Route::get('search', [searchController::class, 'search'])->name('search');
Route::get('search/{slug}', [searchController::class, 'show'])->name('show');
Route::get('search?key={key}&type={type}', [searchController::class, 'search'])->name('search.key.type');

Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::get('password/reset', [AuthenticationController::class, 'reset'])->name('password.reset');

Route::post('password-link', [AccountController::class, 'resetPassword'])->name('password.reset.post');


Route::get('notification/reset-password', [AccountController::class, 'notificationSuccess'])->name('notification.rest-password.success');
Route::post('reset-password', [AccountController::class, 'newPassword'])->name('password.update');


// Auth middleware
Route::group([
    'middleware' => 'App\Http\Middleware\Auth',
], function () {

    Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');

    Route::get('accounts', [AccountController::class, 'index'])->name('accounts.index');
    Route::get('favorites', [AccountController::class, 'indexFavoris'])->name('accounts.favorite.index');
    Route::get('comments', [AccountController::class, 'indexComment'])->name('accounts.comment.index');



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

        Route::resource('patisseries', PatisserieController::class)->parameters(['patisseries' => 'patisserie']);
    });

    Route::get('pricing', [AbonnementController::class, 'choiceIndex'])->name('pricing');

    Route::resource('abonnements', AbonnementController::class);
    Route::get('abonnements/list/datatable', [AbonnementController::class, 'getDataTable'])->name('abonnements.datatable');
    Route::post('abonnements/payment/check', [AbonnementController::class, 'checkPayment'])->name('abonnements.payement.check');

    Route::resource('payments', PaiementController::class);

    Route::resource('subscriptions', SubscriptionController::class);
    Route::get('subscriptions/list/datatable', [AbonnementController::class, 'getDataTable'])->name('subscription.datatable');


});

Route::fallback(function () {
    return view('errors.404');
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



Route::get('/test', function () {
    // return route('payment.notification');
    // send a mail
    Mail::to('billali.sonhouin@numrod.fr')->send(new App\Mail\SubscriptionConfirmation('Billal', 'Abonnement', '1', '01/01/2021', '01/01/2022'));
    // Mail::send(new App\Mail\SubscriptionInformation('Billal', 'Abonnement', 3000, '1', '01/01/2021', '01/01/2022'));
    // $user = App\Models\User::inRandomOrder()->first();
    // $subscription = Abonnement::inRandomOrder()->first();


    // Mail::send(new App\Mail\SubscriptionInformation(
    //     $user,
    //     1,
    //     $subscription
    // ));

});

Route::get('/test-notification', function () {
    $user = \App\Models\User::first(); // Get the first user as an example
    $user->notify(new ResetPassword('token123')); // Replace 'token123' with your actual token
});

