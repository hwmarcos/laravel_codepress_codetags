<?php

Route::group(['prefix' => 'admin/tags', 'as' => 'admin.tags.', 'middleware' => ['web'], 'namespace' => 'CodePress\CodeTag\Controllers'], function () {
    Route::get('/', ['uses' => 'TagController@index', 'as' => 'index']);
    Route::get('/create', ['uses' => 'TagController@create', 'as' => 'create']);
    Route::post('/store', ['uses' => 'TagController@store', 'as' => 'store']);

    Route::get('/edit/{id}', ['uses' => 'TagController@edit', 'as' => 'edit']);
    Route::post('/update', ['uses' => 'TagController@update', 'as' => 'update']);
    Route::get('/delete/{id]', ['uses' => 'TagController@delete', 'as' => 'delete']);
});
