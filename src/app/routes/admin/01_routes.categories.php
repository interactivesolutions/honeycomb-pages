<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('pages/categories', ['as' => 'admin.categories', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@adminIndex']);

    Route::group(['prefix' => 'api/categories'], function ()
    {
        Route::get('/', ['as' => 'admin.api.categories', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@apiIndexPaginate']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_create'], 'uses' => 'HCCategoriesController@apiStore']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_delete'], 'uses' => 'HCCategoriesController@apiDestroy']);

        Route::get('list', ['as' => 'admin.api.categories.list', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@apiIndex']);
        Route::post('merge', ['as' => 'admin.api.categories.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_create', 'acl:interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@apiMerge']);
        Route::post('restore', ['as' => 'admin.api.categories.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@apiRestore']);
        Route::delete('force', ['as' => 'admin.api.categories.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_force_delete'], 'uses' => 'HCCategoriesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.categories.single', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_delete'], 'uses' => 'HCCategoriesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.categories.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_update'], 'uses' => 'HCCategoriesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.categories.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_create'], 'uses' => 'HCCategoriesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.categories.force', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_force_delete'], 'uses' => 'HCCategoriesController@apiForceDelete']);
        });
    });
});