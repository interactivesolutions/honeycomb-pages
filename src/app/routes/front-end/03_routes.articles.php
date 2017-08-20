<?php

Route::group(['prefix' => '{lang}/articles/', 'middleware' => 'web'], function () {

    Route::get('{year?}/{month?}/{day?}/{slug?}', ['as' => 'article', 'uses' => 'frontend\\HCPagesController@showArticle']);
});
