<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/blogs','BlogController@index')->name('blog.index');
Route::get('/blogs/create','BlogController@create')->middleware('auth')->name('blog.create');
Route::get('/blogs/user/{user}','BlogController@userBlogs')->name('user.blogs')->middleware('auth');
Route::get('/blogs/{blog}','BlogController@show')->name('blog.show');
Route::post('/blogs','BlogController@store')->name('blog.store')->middleware('auth');
Route::get('/blogs/{blog}/edit','BlogController@edit')->name('blog.edit')->middleware('auth');
Route::put('/blogs/{blog}','BlogController@update')->name('blog.update')->middleware('auth');
Route::delete('/blogs/{blog}','BlogController@destroy')->name('blog.destroy')->middleware('auth');

Route::get('/tags','TagController@index')->name('tag.index')->middleware('auth');
Route::get('/tags/create','TagController@create')->name('tag.create')->middleware('auth');
Route::post('/tags','TagController@store')->name('tag.store')->middleware('auth');
Route::get('/tags/user/{user}','TagController@userTags')->name('user.tags')->middleware('auth');

Route::put('/tags/{tag}','TagController@update')->name('tag.update')->middleware('auth');
Route::delete('/tags/{tag}','TagController@destroy')->name('tag.destroy')->middleware('auth');


Route::get('/contact','ContactController@show');
Route::post('/contact','ContactController@sendMail')->name('contact.sendmail');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/donate','DonationController@store')->name('donation.store');

Route::get('/notifications/mark-read','DonationController@markAllRead')->name('markall.read')->middleware('auth');
Route::get('/notifications/mark-read/{id}','DonationController@markOneRead')->name('markone.read')->middleware('auth');
