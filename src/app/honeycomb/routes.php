<?php

//honeycomb-pages/src/app/routes/admin/routes.categories.php


Route::group(['prefix' => env('HC_ADMIN_URL'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('pages/categories', ['as' => 'admin.categories', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_categories_list'], 'uses' => 'HCCategoriesController@adminView']);

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


//honeycomb-pages/src/app/routes/admin/routes.pages.php


Route::group(['prefix' => env('HC_ADMIN_URL'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('pages', ['as' => 'admin.pages', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@adminView']);

    Route::group(['prefix' => 'api/pages'], function ()
    {
        Route::get('/', ['as' => 'admin.api.pages', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@listPage']);
        Route::get('list', ['as' => 'admin.api.pages.list', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@list']);
        Route::get('list/{timestamp}', ['as' => 'admin.api.pages.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@listUpdate']);
        Route::get('search', ['as' => 'admin.api.pages.search', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@listSearch']);
        Route::get('{id}', ['as' => 'admin.api.pages.single', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'admin.api.pages.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@duplicate']);
        Route::post('restore', ['as' => 'admin.api.pages.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@restore']);
        Route::post('merge', ['as' => 'admin.api.pages.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@merge']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_create'], 'uses' => 'HCPagesController@create']);

        Route::put('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@update']);
        Route::put('{id}/strict', ['as' => 'admin.api.pages.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_delete'], 'uses' => 'HCPagesController@delete']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_delete'], 'uses' => 'HCPagesController@delete']);
        Route::delete('{id}/force', ['as' => 'admin.api.pages.force', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_force_delete'], 'uses' => 'HCPagesController@forceDelete']);
        Route::delete('force', ['as' => 'admin.api.pages.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_force_delete'], 'uses' => 'HCPagesController@forceDelete']);
    });
});


//honeycomb-pages/src/app/routes/api/routes.categories.php


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


//honeycomb-pages/src/app/routes/api/routes.pages.php


Route::group(['prefix' => 'api', 'middleware' => ['web', 'auth-apps']], function ()
{
    Route::group(['prefix' => 'v1/pages'], function ()
    {
        Route::get('/', ['as' => 'api.v1.pages', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@listPage']);
        Route::get('list', ['as' => 'api.v1.pages.list', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@list']);
        Route::get('list/{timestamp}', ['as' => 'api.v1.pages.list.update', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@listUpdate']);
        Route::get('search', ['as' => 'api.v1.pages.search', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@listSearch']);
        Route::get('{id}', ['as' => 'api.v1.pages.single', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@getSingleRecord']);

        Route::post('{id}/duplicate', ['as' => 'api.v1.pages.duplicate', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@duplicate']);
        Route::post('restore', ['as' => 'api.v1.pages.restore', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@restore']);
        Route::post('merge', ['as' => 'api.v1.pages.merge', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@merge']);
        Route::post('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_create'], 'uses' => 'HCPagesController@create']);

        Route::put('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@update']);
        Route::put('{id}/strict', ['as' => 'api.v1.pages.update.strict', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@updateStrict']);

        Route::delete('{id}', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_delete'], 'uses' => 'HCPagesController@delete']);
        Route::delete('/', ['middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_delete'], 'uses' => 'HCPagesController@delete']);
        Route::delete('{id}/force', ['as' => 'api.v1.pages.force', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_force_delete'], 'uses' => 'HCPagesController@forceDelete']);
        Route::delete('force', ['as' => 'api.v1.pages.force.multi', 'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_force_delete'], 'uses' => 'HCPagesController@forceDelete']);
    });
});


//honeycomb-pages/src/app/routes/front-end/routes.pages.php


Route::get('pages/{year?}/{month?}/{day?}/{slug?}', ['middleware' => ['web'], 'uses' => 'HCPagesFrontEndController@showData']);

