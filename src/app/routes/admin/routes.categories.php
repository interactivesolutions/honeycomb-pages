<?php

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function ()
{
    Route::get('categories', ['as' => 'admin.categories', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@adminView']);

    Route::group(['prefix' => 'api/categories'], function ()
    {
        Route::get('/', ['as' => 'admin.api.categories', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@listPage']);
        Route::get('list', ['as' => 'admin.api.categories.list', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@list']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.categories.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@listUpdate']);
        Route::get('search', ['as' => 'admin.api.categories.search', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@listSearch']);
        Route::get('{id}', ['as' => 'admin.api.categories.single', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'admin.api.categories.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@duplicate']);
        Route::post('restore', ['as' => 'admin.api.categories.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@restore']);
        Route::post('merge', ['as' => 'admin.api.categories.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_create'], 'uses' => 'HCCategoriesController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@update']);
        Route::put('{id}/strict', ['as' => 'admin.api.categories.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_delete'], 'uses' => 'HCCategoriesController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_delete'], 'uses' => 'HCCategoriesController@delete']);
        Route::delete('{id}/force', ['as' => 'admin.api.categories.force', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_force_delete'], 'uses' => 'HCCategoriesController@forceDelete']);
        Route::delete('force', ['as' => 'admin.api.categories.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_force_delete'], 'uses' => 'HCCategoriesController@forceDelete']);
    });
});
