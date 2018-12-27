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
/**
* root directory
* @return text.
*/
Route::get('/', function () {
	return 'Welcome';
});

/**
* quizz sub routes directory
* 
*/
Route::get('/quizz', 'QuizzController@index')->name('quizz');
/*Route::get('/quizz', function (\App\Question $q) {
	return view('test')->with('quest', $q->with('choices')->first()->toJson());
});*/

/**
* Request to 
*/
Route::post('/quizz/{questId}/{choicedId}', 'QuizzController@choiceChecker');

/**
* adding question area
*/

Route::get('/quizz/create', 'QuizzController@create')->name('quizz.create');
/**
* change the question
*/
Route::post('/quizz/change/{questId}', 'QuizzController@change')->name('quizz.change');

/**
* post
*/
Route::post('/quizz/store', 'QuizzController@store')->name('quizz.store');
