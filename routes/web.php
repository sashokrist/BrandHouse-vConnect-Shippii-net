<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Status2Controller;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
/**
 * Authentication
 */
Route::get('/signup', [AuthController::class, 'getSignup'])->name('auth.signup');
Route::post('/signup', [AuthController::class, 'postSignup']);
Route::get('/signin', [AuthController::class, 'getSignin'])->name('auth.signin');
Route::post('/signin', [AuthController::class, 'postSignin']);
Route::get('/signout', [AuthController::class, 'getSignout'])->name('auth.signout');
/**
 * Search
 */
Route::get('/search', [SearchController::class, 'getResults'])->name('search.results');
/**
 * User profile
 */
Route::get('/user/{username}', [ProfileController::class, 'getProfile'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'getEdit'])->name('profile.edit');
Route::post('/profile/edit', [ProfileController::class, 'postEdit']);
/**
 * Friends
 */
Route::get('/friends', [FriendController::class, 'getIndex'])->name('friend.index');
Route::get('/friends/add/{username}', [FriendController::class, 'getAdd'])->name('friend.add');
Route::get('/friends/accept/{username}', [FriendController::class, 'getAccept'])->name('friend.accept');
/**
 * Statuses
 */
Route::post('/status', [StatusController::class, 'postStatus'])->name('status.post');
Route::post('/status/{statusId}/reply', [StatusController::class, 'postReply'])->name('status.reply');
Route::get('/status/{statusId}/like', [StatusController::class, 'getLike'])->name('status.like');
/**
 *Questionnaires
 */
Route::get('questionnaires/index', [QuestionnaireController::class, 'index'])->name('questionnaires/index');
Route::get('/questionnaires/create', [QuestionnaireController::class, 'create'])->name('questionnaires/create');
Route::post('/questionnaires', [QuestionnaireController::class, 'store'])->name('questionnaires');
Route::get('/questionnaires/{questionnaire}', [QuestionnaireController::class, 'show']);
Route::get('/questionnaires/{questionnaire}/questions/create', [QuestionController::class, 'create']);
Route::post('/questionnaires/{questionnaire}/questions', [QuestionController::class, 'store']);
Route::delete('/questionnaires/{questionnaire}/questions/{question}', [QuestionController::class, 'destroy']);
Route::get('/surveys/{questionnaire}-{slug}', [SurveyController::class, 'show']);
Route::post('/surveys/{questionnaire}-{slug}', [SurveyController::class, 'store']);




