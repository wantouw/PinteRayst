<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PinController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'start'])->name('start');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/regis_page', [UserController::class, 'regis_page'])->name('regis_page');
Route::post('/regis', [UserController::class, 'regis'])->name('regis');

Route::group(['middleware' => 'guestMiddleware'], function () {
    Route::get('/guest_home', [UserController::class, 'guest_home'])->name('guest_home');
    Route::post('/search_guest', [UserController::class, 'search_guest'])->name('search_guest');
});

Route::group(['middleware' => 'userMiddleware'], function () {
    Route::get('/search', [HomeController::class, 'search'])->name('search');
    Route::get('/pin_detail/{pin_id}', [PinController::class, 'detail_page'])->name('pin_detail');
    Route::post('/comment/{user_id}on{pin_id}', [PinController::class, 'comment'])->name('comment');
    Route::post('/save/{pin_id}as{user_id}', [PinController::class, 'save'])->name('save');
    Route::post('/unsave/{pin_id}as{user_id}', [PinController::class, 'unsave'])->name('unsave');

    Route::get('/create_page/{user_id}', [UserController::class, 'create_page'])->name('create_page');
    Route::post('/create', [PinController::class, 'create'])->name('create');
    Route::get('/home_page/{user_id}', [HomeController::class, 'home_page'])->name('home_page');

    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/profile/{user_id}created', [UserController::class, 'profile_created'])->name('profile_created');
    Route::get('/profile/{user_id}saved', [UserController::class, 'profile_saved'])->name('profile_saved');

    Route::get('/profile/pin/{pin_id}', [PinController::class, 'created_pin_detail'])->name('created_pin_detail');
    Route::get('/profile/update/page{user_id}', [UserController::class, 'update_profile_page'])->name('update_profile_page');
    Route::patch('/profile/update/{user_id}', [UserController::class, 'update_profile'])->name('update_profile');

    Route::get('/update/pin/page{pin_id}', [PinController::class, 'update_pin_page'])->name('update_pin_page');
    Route::delete('/delete_pin/{pin_id}', [PinController::class, 'delete_pin'])->name('delete_pin');
    Route::patch('/update/pin{pin_id}', [PinController::class, 'update_pin'])->name('update_pin');
});


Route::group(['middleware' => 'adminMiddleware'], function () {
    Route::get('/admin/home', [HomeController::class, 'admin_home'])->name('admin_home');
    Route::get('/admin/pin_detail{pin_id}', [PinController::class, 'admin_pin_detail'])->name('admin_pin_detail');
    Route::delete('/admin/delete_pin{pin_id}', [PinController::class, 'admin_delete_pin'])->name('admin_delete_pin');
    Route::post('/search_admin', [HomeController::class, 'search_admin'])->name('search_admin');

    Route::get('/admin/users', [HomeController::class, 'admin_users'])->name('admin_users');
    Route::delete('admin/delete_user{user_id}', [UserController::class, 'admin_delete_user'])->name('admin_delete_user');

    Route::get('/admin/profile', [UserController::class, 'admin_profile'])->name('admin_profile');
});
