<?php

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

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\CommunityController;
use App\Mail\WelcomMail;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\NewsController;

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::get('home', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('home', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});
Route::get('adduser', [ProfileController::class, 'addUser'])->middleware('auth')->name('adduser');
Route::post('adduser', [ProfileController::class, 'postAddUser'])->middleware('auth')->name('postadduser');
Route::get('user-management', [ProfileController::class, 'userManagement'])->middleware('auth')->name('user-management');;
Route::get('/delete/{id}', [ProfileController::class, 'deleteUser'])->middleware('auth')->name('delete-user');
Route::get('/edit-user/{id}', [ProfileController::class, 'editUser'])->middleware('auth')->name('edit-user');
Route::post('/edituser/{id}', [ProfileController::class, 'postEditUser'])->middleware('auth')->name('edituser');

Route::get('configuration', [DashboardController::class, 'config'])->middleware('auth')->name('config');
Route::post('slider', [DashboardController::class, 'postSlider'])->middleware('auth')->name('slider');
Route::get('/edit-slider/{id}', [DashboardController::class, 'editSlider'])->middleware('auth')->name('edit-slider');
Route::post('/slider-update/{id}', [DashboardController::class, 'updateSlider'])->middleware('auth')->name('slider-update');
Route::get('/delete-slider/{id}', [DashboardController::class, 'deleteSlider'])->middleware('auth')->name('delete-slider');
Route::get('logos', [DashboardController::class, 'logo'])->middleware('auth')->name('get-logo');
Route::post('/postlogo', [DashboardController::class, 'postLogo'])->middleware('auth')->name('post-logo');
Route::post('contact', [DashboardController::class, 'contact'])->middleware('auth')->name('contact');

Route::get('event', [EventController::class, 'getEvent'])->middleware('auth')->name('get-event');
Route::get('add-event', [EventController::class, 'addEvent'])->middleware('auth')->name('add-event');

Route::post('add-event', [EventController::class, 'postAddEvent'])->middleware('auth')->name('post-event');
Route::get('delete-event/{id}', [EventController::class, 'deleteEvent'])->middleware('auth')->name('delete-event');

Route::get('deleted-event', [EventController::class, 'deletedEvent'])->middleware('auth')->name('deleted-event');
Route::get('restore-event/{id}', [EventController::class, 'restoreEvent'])->middleware('auth')->name('restore-event');

Route::get('delet-event/{id}', [EventController::class, 'deletEvent'])->middleware('auth')->name('dele-event');

Route::get('edit-event/{id}', [EventController::class, 'getEditEvent'])->middleware('auth')->name('get-edit-event');
Route::post('post-edit-event/{id}', [EventController::class, 'postEditEvent'])->middleware('auth')->name('post-edit-event');

Route::get('media', [EventController::class, 'getMedia'])->middleware('auth')->name('get-media');

Route::get('activity-log', [LogController::class, 'getLog'])->middleware('auth')->name('get-log');

Route::get('/emails', function(){
	// Mail::to("miketayo1@gmail.com")->send(new WelcomMail());
	return new WelcomMail();
});

Route::get('user-token', [ApiController::class, 'getToken'])->middleware('auth')->name('get-token');
Route::post('user-token', [ApiController::class, 'postToken'])->middleware('auth')->name('post-token');

Route::get('news', [NewsController::class, 'news'])->middleware('auth')->name('get-news');
Route::get('add-news', [NewsController::class, 'createNews'])->middleware('auth')->name('create-news');
Route::post('add-news', [NewsController::class, 'postNews'])->middleware('auth')->name('post-news');

Route::get('delete-news/{id}', [NewsController::class, 'deleteNews'])->middleware('auth')->name('delete-news');