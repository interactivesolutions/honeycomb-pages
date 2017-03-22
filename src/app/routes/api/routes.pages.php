<?php

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
