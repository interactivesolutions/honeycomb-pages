<?php

Route::group(['prefix' => config('hc.admin_url'), 'middleware' => ['web', 'auth']], function ()
{
    Route::get('pages', ['as' => 'admin.pages', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@adminIndex']);

    Route::group(['prefix' => 'api/pages'], function ()
    {
        Route::get('/', ['as' => 'admin.api.pages', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@apiIndexPaginate']);
        Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_delete'], 'uses' => 'HCPagesController@apiDestroy']);
        Route::post('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_create'], 'uses' => 'HCPagesController@apiStore']);

        Route::get('list', ['as' => 'admin.api.pages.list', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@apiIndex']);
        Route::post('restore', ['as' => 'admin.api.pages.restore', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@apiRestore']);
        Route::post('merge', ['as' => 'admin.api.pages.merge', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_create', 'acl:interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@apiMerge']);
        Route::delete('force', ['as' => 'admin.api.pages.force.multi', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_force_delete'], 'uses' => 'HCPagesController@apiForceDelete']);

        Route::group(['prefix' => '{id}'], function ()
        {
            Route::get('/', ['as' => 'admin.api.pages.single', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_list'], 'uses' => 'HCPagesController@apiShow']);
            Route::put('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@apiUpdate']);
            Route::delete('/', ['middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_delete'], 'uses' => 'HCPagesController@apiDestroy']);

            Route::put('strict', ['as' => 'admin.api.pages.update.strict', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_update'], 'uses' => 'HCPagesController@apiUpdateStrict']);
            Route::post('duplicate', ['as' => 'admin.api.pages.duplicate', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_create'], 'uses' => 'HCPagesController@apiDuplicate']);
            Route::delete('force', ['as' => 'admin.api.pages.force', 'middleware' => ['acl:interactivesolutions_honeycomb_pages_pages_force_delete'], 'uses' => 'HCPagesController@apiForceDelete']);
        });
    });
});
