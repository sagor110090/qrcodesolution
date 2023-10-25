<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\EmailVerificationController;

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

Route::redirect('home', '/')->name('home');

Route::get('/q/{code}', App\Http\Controllers\DynamicQrCodeRedirectController::class)->name('qrcode.show')->middleware('tracking');



Route::get('/login/{social}',[LoginController::class,'socialLogin'])->where('social','twitter|facebook|linkedin|google|github|bitbucket')->name('login.social');
Route::get('/login/{social}/callback',[LoginController::class,'handleProviderCallback'])->where('social','twitter|facebook|linkedin|google|github|bitbucket');
Route::middleware('auth')->group(function () {

    // Route::get('/my-qrcode/{qrCode}/edit', App\Livewire\MyQrcode\Edit::class)->name('my-qrcode.edit');

    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');
    Route::post('logout', LogoutController::class)
        ->name('logout');
});




Route::middleware('admin')
->prefix('admin')
->group(function () {
    Route::post('logout', function () {
        Auth::guard('admin')->logout();
        return redirect()->route('home');
    })->name('admin.logout');
    Route::post('image-upload', App\Http\Controllers\ImageUploadController::class)->name('ckeditor.image-upload');


    Route::get('categories', App\Livewire\Category\Index::class)->name('categories.index');
    Route::get('tags', App\Livewire\Tag\Index::class)->name('tags.index');
    Route::get('posts', App\Livewire\Post\Index::class)->name('posts.index');
    Route::get('posts/create', App\Livewire\Post\CreatePost::class)->name('posts.create');
    Route::get('posts/{id}/edit', App\Livewire\Post\EditPost::class)->name('posts.edit');
    Route::get('pages', App\Livewire\Page\Index::class)->name('pages.index');
    Route::get('pages/create', App\Livewire\Page\CreatePage::class)->name('pages.create');
    Route::get('pages/{id}/edit', App\Livewire\Page\EditPage::class)->name('pages.edit');
});
