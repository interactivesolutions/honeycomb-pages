<?php

Route::group(['prefix' => '{lang}/articles/', 'middleware' => 'web'], function () {

    Route::get('{year?}/{month?}/{day?}/{slug?}', ['as' => 'page', 'uses' => 'HCPagesFrontEndController@showArticle']);
});
