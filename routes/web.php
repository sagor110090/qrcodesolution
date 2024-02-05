<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\EmailVerificationController;


//

Route::domain(config('app.domain'))->group(function () {
    Route::redirect('/home', '/');
});

Route::get('/q/{code}', App\Http\Controllers\DynamicQrCodeRedirectController::class)->name('qrcode.show')->middleware('tracking');

//event create
Route::view('/event-create','dynamic.event-create')->name('event.create');

//event show
Route::domain('{code}.' . config('app.domain'))->get('/', App\Http\Controllers\DynamicQrCodeRedirectController::class)->name('qrcode.show')->middleware('tracking');


//event create
Route::view('/social-create','dynamic.social-create')->name('social.create');


Route::get('/login/{social}', [LoginController::class, 'socialLogin'])->where('social', 'twitter|facebook|linkedin|google|github|bitbucket')->name('login.social');
Route::get('/login/{social}/callback', [LoginController::class, 'handleProviderCallback'])->where('social', 'twitter|facebook|linkedin|google|github|bitbucket');


Route::domain('app.' . config('app.domain'))->middleware('auth')->group(function () {
    Route::get('my-qrcode/create', App\Livewire\MyQrcode\Create::class)->name('my-qrcode.create')->lazy();
    Route::get('my-qrcode/dynamic', App\Livewire\MyQrcode\DynamicQrcode::class)->name('my-qrcode.dynamic');
    Route::get('my-qrcode/static', App\Livewire\MyQrcode\StaticQrcode::class)->name('my-qrcode.static');
    Route::get('my-qrcode/{subdomain}/edit', App\Livewire\MyQrcode\Edit::class)->name('my-qrcode.edit');
    Route::get('my-qrcode/event/{subdomain}/edit', App\Livewire\MyQrcode\EventEdit::class)->name('my-qrcode.event.edit');
    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)->middleware('signed')->name('verification.verify');
    Route::post('logout', LogoutController::class)->name('logout');
});




Route::domain('admin.' . config('app.domain'))->middleware('admin')->group(function () {
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
    //plans
    Route::get('plans', App\Livewire\Plan\Index::class)->name('plans.index');
    Route::get('users', App\Livewire\User\Index::class)->name('users.index');
    // login.as.user
    Route::get('login-as-user/{id}', App\Http\Controllers\LoginAsUserController::class)->name('login.as.user');
});

Route::get('/user/invoice/{invoiceId}', function ($invoiceId) {
    return auth()->user()->downloadInvoice($invoiceId, [
        'vendor'  => 'qrcodesolution.com',
        'product' => 'Qr Code Solution',
    ]);
})->name('invoice.download')->middleware('auth');
