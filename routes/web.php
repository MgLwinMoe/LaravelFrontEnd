<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;

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

Route::get('app/created_comment',[BlogController::class, 'test']);
// comment
Route::post('app/addComment', [CommentController::class, 'addComment']);
Route::get('/', [BlogController::class, 'index']);
Route::get('/blog/{slug}', [BlogController::class, 'singleBlog']);
Route::get('/category/{categoryName}/{id}',[BlogController::class, 'categoryIndex']);
Route::get('/tag/{tagName}/{id}',[BlogController::class, 'tagIndex']);
Route::get('/blogs',[BlogController::class, 'getBlogs']);
Route::get('/search',[BlogController::class, 'search']);
Route::get('/{vue_capture?}', function () {
    return view('home');
})->where('vue_capture', '[\/\w\.-]*');

