<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/categories', function () {

    return \App\Models\Category::when(request()->search,fn($query,$search) => $query->where('name','like','%'.$search.'%'))
    ->when(request()->exists('selected'),fn($query) => $query->whereIn('id',request()->selected))
    ->get(['id','name']);
})->name('api.category.index');

Route::get('/tags', function () {
    return \App\Models\Tag::when(request()->search,fn($query,$search) => $query->where('name','like','%'.$search.'%'))
                ->when(request()->exists('selected'),fn($query) => $query->whereIn('id',request()->selected))
                ->get(['id','name']);
})->name('api.tag.index');


