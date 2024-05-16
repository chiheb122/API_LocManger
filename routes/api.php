<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\Equipement_Controller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PieceController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\HistoriqueController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// une route pour afficher tous les clients
Route::get('/clients', 'App\Http\Controllers\ClientController@index');
// une route pour afficher un client par son id
Route::get('/client/{id}', 'App\Http\Controllers\ClientController@show');
// une route pour ajouter un client
Route::post('/client', 'App\Http\Controllers\ClientController@store')->middleware('auth:sanctum');
// une route pour modifier un client
Route::put('/client/{id}', 'App\Http\Controllers\ClientController@update');
// une route pour supprimer un client
Route::delete('/client/{id}', 'App\Http\Controllers\ClientController@destroy');



// regrouper les routes pour les équipements
Route::prefix('equipements')->group(function () {
    // une route pour afficher tous les équipements
    Route::get('/', 'App\Http\Controllers\Equipement_Controller@index');
    // une route pour afficher un équipement par son id
    Route::get('/{id}', 'App\Http\Controllers\Equipement_Controller@show');
    // une route pour ajouter un équipement
    Route::post('/', 'App\Http\Controllers\Equipement_Controller@store');
    // une route pour modifier un équipement
    Route::put('/{id}', 'App\Http\Controllers\Equipement_Controller@update');
    // une route pour supprimer un équipement
    Route::delete('/{id}', 'App\Http\Controllers\Equipement_Controller@destroy');

});

// routes automatiques pour les locations
Route::apiResource('locations', 'App\Http\Controllers\LocationController');
//routes automatiques pour les paiements sécurisées
Route::apiResource('paiements', 'App\Http\Controllers\PaiementController')->middleware('auth:sanctum');
//routes automatiques pour les promotions et sécurisées seulement post, put, delete
Route::apiResource('promotions', 'App\Http\Controllers\PromotionController')->only(['store', 'update', 'destroy'])->middleware('auth:sanctum');
Route::get('/promotions', 'App\Http\Controllers\PromotionController@index');

// routes automatiques pour les notifications
Route::apiResource('notifications', 'App\Http\Controllers\NotificationController')->middleware('auth:sanctum');

// routes automatiques pour les employés , sécurisées
Route::apiResource('employes', 'App\Http\Controllers\EmployeController')->middleware('auth:sanctum');

// routes automatiques pour les services , sécurisées
Route::apiResource('services', 'App\Http\Controllers\ServiceController')->middleware('auth:sanctum');


// routes automatiques pour les pièces , sécurisées
Route::apiResource('pieces', 'App\Http\Controllers\PieceController')->middleware('auth:sanctum');

// routes automatiques sécurisé pour les évaluations uniquement post, put, delete
Route::apiResource('evaluations', 'App\Http\Controllers\EvaluationController')->only(['store', 'update', 'destroy'])->middleware('auth:sanctum');



// une route pour afficher les évaluations non sécurisée
Route::get('/evaluations', 'App\Http\Controllers\EvaluationController@index');
Route::get('/evaluations/{id}', 'App\Http\Controllers\EvaluationController@show');
Route::get('/evaluationsEqui_CLi/{id}', 'App\Http\Controllers\EvaluationController@showClient_Equipement');

// routes automatiques pour les historiques , sécurisées
Route::apiResource('historiques', 'App\Http\Controllers\HistoriqueController')->middleware('auth:sanctum');


// une route pour l'authentification
Route::post('/login', [AuthController::class, 'auth']);
// une route pour la déconnexion
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


/* 
    Ajouter des routes personnalisées
*/
Route::get('/servic_pieces/{id}', 'App\Http\Controllers\ServiceController@Avecpiece')->middleware('auth:sanctum');
// une route pour afficher les notifications AVEC les clients et les notifications
Route::get('client_notification', 'App\Http\Controllers\NotificationController@notificationsWithClient')->middleware('auth:sanctum');
// une route pour enregistrer un user et le lier à un client
Route::post('/client_user', 'App\Http\Controllers\ClientController@createClientForUser')->middleware('auth:sanctum');