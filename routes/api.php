<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Events\EventController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile', [ProfileController::class, 'update']);
    Route::patch('settings/password', [PasswordController::class, 'update']);
});

Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);
    Route::post('register', [RegisterController::class, 'register']);

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [ResetPasswordController::class, 'reset']);

    Route::post('email/verify/{user}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/resend', [VerificationController::class, 'resend']);

    Route::post('oauth/{driver}', [OAuthController::class, 'redirect']);
    Route::get('oauth/{driver}/callback', [OAuthController::class, 'handleCallback'])->name('oauth.callback');
});


// Events

    Route::get('events', [EventController::class, 'index']);
    Route::get('event/{id}', [EventController::class, 'show']);



    Route::post('event/create', [EventController::class, 'create']);

    Route::get('event/{id}', [EventController::class, 'show']);
    Route::put('event/update/{id}', [EventController::class, 'update']);
    Route::post('event/delete/{id}', [EventController::class, 'destroy']);
//    Route::post('event/join/{id}', [EventController::class, 'joinEvent']);
//    Route::post('event/book/{id}', [EventController::class, 'bookEvent']);
//    Route::post('event/like/{id}', [EventController::class, 'likeEvent']);
//    Route::put('event/join/{id}', [EventController::class, 'unJoinEvent']);
//    Route::put('event/book/{id}', [EventController::class, 'unBookEvent']);
//    Route::put('event/like/{id}', [EventController::class, 'unLikeEvent']);

    Route::get('style', [EventController::class, 'getStyle']);
    Route::get('game', [EventController::class, 'getGame']);
    Route::get('sport', [EventController::class, 'getSport']);
    Route::get('art', [EventController::class, 'getCulturalJourney']);
    Route::get('city', [EventController::class, 'getCity']);


    Route::post('event/style', [EventController::class, 'eventStyle']);
    Route::post('event/substyle', [EventController::class, 'eventSubStyle']);
    Route::post('event/game', [EventController::class, 'eventGame']);
    Route::post('event/sport', [EventController::class, 'eventSport']);
    Route::post('event/art', [EventController::class, 'eventArt']);

    Route::get('events/myfeed', [EventController::class, 'myFeed']);
    Route::post('event/{event_id}/interest/{type}', [EventController::class, 'interestEvent']);
    Route::get('event/validate/{event_id}', [EventController::class, 'afterCreateEvent']);
    Route::post('event/promote/{event_id}', [EventController::class, 'promote']);






