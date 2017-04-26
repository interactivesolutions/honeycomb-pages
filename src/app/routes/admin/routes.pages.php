<?php

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
