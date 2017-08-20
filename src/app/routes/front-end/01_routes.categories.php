<?php

Route::group(['prefix' => '{lang}/pages/categories/', 'middleware' => ['web']], function () {
    Route::get('/', ['uses' => 'frontend\\HCPagesCategoriesController@showCategoriesList']);
    Route::get('{slug}', ['uses' => 'frontend\\HCPagesCategoriesController@showCategoriesPages']);
});