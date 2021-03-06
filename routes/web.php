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

Route::get('/', 'GuestController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['prefix'=>'admin' , 'middleware'=>['auth']],function(){
//isi route disini
Route::resource('authors', 'AuthorController');
Route::resource('books', 'BookController');
Route::resource('members', 'MembersController');
Route::get('statistics', [
    'as'=>'statistics.index',
    'uses'=>'StatisticsController@index'
]);
Route::get('export/books', [
    'as' => 'export.books',
    'uses' => 'BookController@export'
]);
Route::post('export/books', [
    'as' => 'export.books.post',
    'uses' => 'BookController@exportPost'
]);
Route::get('template/books', [
    'as' => 'template.books',
    'uses' => 'BooksController@generateExcelTemplate'
]);
Route::post('import/books', [
    'as' => 'import.books',
    'uses' => 'BooksController@importExcel'
]);
        
});
Route::get('books/{book}/borrow', ['middleware' => ['auth', 'role:member'],'as' => 'pinjambuku','uses' => 'BookController@borrow'
]);
Route::put('books/{book}/return', ['middleware' => ['auth', 'role:member'],'as' => 'kembalikanbuku','uses' => 'BookController@returnBack'
]); 
Route::get('auth/verify/{token}', 'Auth\RegisterController@verify');
Route::get('auth/send-verification', 'Auth\RegisterController@sendVerification');
Route::get('settings/profile', 'SettingsController@profile');
Route::post('settings/profile', 'SettingsController@updateProfile');
Route::get('settings/profile/edit','SettingsController@editProfile')->name('editprofil');
Route::get('settings/password', 'SettingsController@editPassword');
Route::post('settings/password', 'SettingsController@updatePassword');

