<?php

use Illuminate\Support\Facades\Route;
use App\Repositories\SearchRepository;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('search', 'ArticleController@search')->name('search');

// Route::get('search', function (SearchRepository $repository) {
//     $articles = $repository->search(request('q'));

//     return view('dashboard', [
//         'articles' => $articles,
//     ]);
// })->name('search');

Route::get('/', function () {
    return view('dashboard', [
        'articles' => App\Models\Article::all(),
    ]);
})->name('index');
