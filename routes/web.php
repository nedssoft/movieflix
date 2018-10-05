<?php

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
    return view('landing');
});



Route::group(['prefix' => 'admin'], function(){
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\AdminLoginController@login')->name('admin');
    Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('users', 'AdminController@users')->name('users');
    Route::post('add/user', 'AdminController@addUser')->name('user.add');
    Route::post('user/{user}/edit', 'AdminController@editUser')->name('user.edit');
    Route::get('user/{user}/delete', 'AdminController@deleteUser')->name('user.delete');
    Route::get('videos', 'AdminController@videos')->name('videos');
    Route::get('genres', 'AdminController@genres')->name('genres');
    Route::post('upload/video', 'AdminController@uploadVideo')->name('admin.video.upload');
    Route::post('upload/music/video', 'AdminController@uploadMusicVideo')->name('music.video.upload');
    Route::post('upload/live-tv', 'AdminController@uploadLiveTv')->name('admin.tv.upload');
    Route::post('featured/movie', 'AdminController@setFeaturedMovie')->name('featured.movie');
    Route::post('movie/edit/{movie}', 'AdminController@editVideo')->name('admin.edit.video');
    Route::post('genre/edit/{genre}', 'AdminController@editGenre')->name('admin.genre.edit');
    Route::post('genre/add', 'AdminController@addGenre')->name('admin.genre.add');
    Route::post('music/sub-genre/add', 'AdminController@addMusicSubGenre')->name('music-sub-genre.add');
    Route::get('movie/{movie}/delete', 'AdminController@deleteMovie')->name('admin.movie.delete');
    Route::get('genre/{genre}/delete', 'AdminController@deleteGenre')->name('genre.delete');
    Route::get('audio', 'AdminController@audio')->name('audio');
    Route::post('audio/type', 'AdminController@audioType')->name('audio.type.add');
    Route::post('audio/genre', 'AdminController@audioGenre')->name('audio.genre.add');
    Route::post('audio/upload', 'AdminController@audioUpload')->name('audio.upload');
    Route::post('audio/{audio}/edit', 'AdminController@audioUpdate')->name('audio.edit');
    Route::get('audio/{audio}/delete', 'AdminController@audioDelete')->name('audio.delete');
    Route::get('audio/{audio}/{name}/play', 'AdminController@playAudio')->name('play.audio');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/movie/{movie}/{title}/play', 'HomeController@playMovie')->name('view.movie');
    Route::get('search', 'HomeController@search')->name('search');
Route::get('audio/{audio}/{name}/play', 'HomeController@playAudio')->name('play.audio');
Route::get('genre/{genre}/{name}/view', 'HomeController@showGenres')->name('view.genre');
Route::get('audio/{audio_genre}/{name}/view', 'HomeController@showAudioGenres')->name('view.audio');