<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\Status2Controller;
use App\Http\Controllers\SurveyController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

/**
 * Home
 */

Route::get('/', [
    'uses' => '\App\Http\Controllers\HomeController@index',
    'as' => 'home',
]);

/**
 * Authentication
 */

Route::get('/signup', [
    'uses' => '\App\Http\Controllers\AuthController@getSignup',
    'as' => 'auth.signup',
    'middleware' => ['guest'],
]);

Route::post('/signup', [
    'uses' => '\App\Http\Controllers\AuthController@postSignup',
    'middleware' => ['guest'],
]);

Route::get('/signin', [
    'uses' => '\App\Http\Controllers\AuthController@getSignin',
    'as' => 'auth.signin',
    'middleware' => ['guest'],
]);

Route::post('/signin', [
    'uses' => '\App\Http\Controllers\AuthController@postSignin',
    'middleware' => ['guest'],
]);

Route::get('/signout', [
    'uses' => '\App\Http\Controllers\AuthController@getSignout',
    'as' => 'auth.signout',
]);

/**
 * Search
 */

Route::get('/search', [
    'uses' => '\App\Http\Controllers\SearchController@getResults',
    'as' => 'search.results',
]);

/**
 * User profile
 */

Route::get('/user/{username}', [
    'uses' => '\App\Http\Controllers\ProfileController@getProfile',
    'as' => 'profile.index',
]);

Route::get('/profile/edit', [
    'uses' => '\App\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware' => ['auth'],
]);

Route::post('/profile/edit', [
    'uses' => '\App\Http\Controllers\ProfileController@postEdit',
    'middleware' => ['auth'],
]);

/**
 * Friends
 */

Route::get('/friends', [
    'uses' => '\App\Http\Controllers\FriendController@getIndex',
    'as' => 'friend.index',
    'middleware' => ['auth'],
]);

Route::get('/friends/add/{username}', [
    'uses' => '\App\Http\Controllers\FriendController@getAdd',
    'as' => 'friend.add',
    'middleware' => ['auth'],
]);

Route::get('/friends/accept/{username}', [
    'uses' => '\App\Http\Controllers\FriendController@getAccept',
    'as' => 'friend.accept',
    'middleware' => ['auth'],
]);

/**
 * Statuses
 */

Route::post('/status', [
    'uses' => '\App\Http\Controllers\StatusController@postStatus',
    'as' => 'status.post',
    'middleware' => ['auth'],
]);

Route::post('/status/{statusId}/reply', [
    'uses' => '\App\Http\Controllers\StatusController@postReply',
    'as' => 'status.reply',
    'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/like', [
    'uses' => '\App\Http\Controllers\StatusController@getLike',
    'as' => 'status.like',
    'middleware' => ['auth'],
]);

//Poll
//Route::get('poll/index', [ QuestionnaireController::class, 'index'])->name('poll/index');
Route::get('/questionnaires/create', [ QuestionnaireController::class, 'create'])->name('questionnaires/create');
Route::post('/questionnaires', [ QuestionnaireController::class, 'store'])->name('questionnaires');
Route::get('/questionnaires/{questionnaire}', [ QuestionnaireController::class, 'show']);

Route::get('/questionnaires/{questionnaire}/questions/create',  [ QuestionController::class, 'create']);
Route::post('/questionnaires/{questionnaire}/questions',  [ QuestionController::class, 'store']);

Route::get('/surveys/{questionnaire}-{slug}',  [ SurveyController::class, 'show']);
Route::post('/surveys/{questionnaire}-{slug}',  [ SurveyController::class, 'store']);




