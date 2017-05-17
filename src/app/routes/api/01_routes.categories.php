<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/categories'], function ()
    {
        Route::get('/', ['as' => 'api.v1.categories', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_create'], 'uses' => 'HCCategoriesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_delete'], 'uses' => 'HCCategoriesController@apiDestroy']);

        Route::group(['prefix' => 'list'], function ()
        {
            Route::get('list', ['as' => 'api.v1.categories.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@apiIndex']);
            Route::get('list/{timestamp}', ['as' => 'api.v1.categories.list.update', 'middleware' => ['acl-apps:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@apiIndexSync']);
        });

        Route::post('restore', ['as' => 'api.v1.categories.restore', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@apiRestore']);
        Route::post('merge', ['as' => 'api.v1.categories.merge', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_create', 'acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@apiMerge']);
        Route::delete('force', ['as' => 'api.v1.categories.force.multi', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_force_delete'], 'uses' => 'HCCategoriesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'api.v1.categories.single', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@apiShow']);
            Route::put('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_delete'], 'uses' => 'HCCategoriesController@apiDestroy']);

            Route::put('strict', ['as' => 'api.v1.categories.update.strict', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'api.v1.categories.duplicate', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_create'], 'uses' => 'HCCategoriesController@apiDuplicate']);
            Route::delete('force', ['as' => 'api.v1.categories.force', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_categories_force_delete'], 'uses' => 'HCCategoriesController@apiForceDelete']);
        });
    });
});

