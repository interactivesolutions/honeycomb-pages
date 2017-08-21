<?php

Route::group(['prefix' => '{lang}/pages/categories/'], function () {
    Route::get('/', ['uses' => 'frontend\\HCPagesCategoriesController@showCategoriesList']);
    Route::get('{slug}', ['uses' => 'frontend\\HCPagesCategoriesController@showCategoriesPages']);
});

Route::group(['prefix' => '{lang}/articles/categories/'], function () {
    Route::get('/', ['uses' => 'frontend\\HCPagesCategoriesController@showCategoriesList']);
    Route::get('{slug}', ['uses' => 'frontend\\HCPagesCategoriesController@showCategoriesArticles']);
});