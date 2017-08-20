<?php

Route::group(['prefix' => '{lang}/pages/', 'middleware' => 'web'], function () {

    Route::get('{slug?}', ['as' => 'page', 'uses' => 'frontend\\HCPagesController@showPage']);
});
