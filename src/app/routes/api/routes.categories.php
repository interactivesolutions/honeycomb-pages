<?php

Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/categories'], function ()
    {
        Route::get('/', ['as' => 'api.v1.categories', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@listPage']);
        Route::get('list', ['as' => 'api.v1.categories.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@list']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.categories.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@listUpdate']);
        Route::get('search', ['as' => 'api.v1.categories.search', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@listSearch']);
        Route::get('{id}', ['as' => 'api.v1.categories.single', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'api.v1.categories.duplicate', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@duplicate']);
        Route::post('restore', ['as' => 'api.v1.categories.restore', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@restore']);
        Route::post('merge', ['as' => 'api.v1.categories.merge', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@merge']);
        Route::post('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_create'], 'uses' => 'HCCategoriesController@create']);

        Route::put('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@update']);
        Route::put('{id}/strict', ['as' => 'api.v1.categories.update.strict', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_delete'], 'uses' => 'HCCategoriesController@delete']);
        Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_delete'], 'uses' => 'HCCategoriesController@delete']);
        Route::delete('{id}/force', ['as' => 'api.v1.categories.force', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_force_delete'], 'uses' => 'HCCategoriesController@forceDelete']);
        Route::delete('force', ['as' => 'api.v1.categories.force.multi', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_force_delete'], 'uses' => 'HCCategoriesController@forceDelete']);
    });
});
