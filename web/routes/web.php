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

Route::get('/',[App\Http\Controllers\IndexController::class ,'index']);
Route::get('sitemap',[App\Http\Controllers\SitemapController::class ,'index']);
Route::get('sitemap-articles',[App\Http\Controllers\SitemapController::class ,'articles']);
Route::get('sitemap-services',[App\Http\Controllers\SitemapController::class ,'services']);
Route::get('sitemap-projects',[App\Http\Controllers\SitemapController::class ,'projects']);
