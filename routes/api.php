<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('lesson/{id}/tags', 'TagController@index');
Route::resource('lesson', 'LessonController');
Route::resource('tags', 'TagController', ['only'=>['index', 'show']]);
// Route::resource('lesson.tags', 'LessonTagController');
