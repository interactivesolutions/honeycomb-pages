<?php

Route::group(['prefix' => 'api', 'middleware' => ['auth-apps']], function() {
    Route::group(['prefix' => 'v1/pages'], function() {
        Route::get('/', [
            'as' => 'api.v1.pages',
            'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_list'],
            'uses' => 'HCPagesController@apiIndexPaginate',
        ]);
        Route::post('/', [
            'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_create'],
            'uses' => 'HCPagesController@apiStore',
        ]);
        Route::delete('/', [
            'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_delete'],
            'uses' => 'HCPagesController@apiDestroy',
        ]);

        Route::group(['prefix' => 'list'], function() {
            Route::get('/', [
                'as' => 'api.v1.pages.list',
                'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_list'],
                'uses' => 'HCPagesController@apiIndex',
            ]);
            Route::get('{timestamp}', [
                'as' => 'api.v1.pages.list.update',
                'middleware' => ['acl-apps:interactivesolutions_honeycomb_pages_pages_list'],
                'uses' => 'HCPagesController@apiIndexSync',
            ]);
        });

        Route::post('restore', [
            'as' => 'api.v1.pages.restore',
            'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_update'],
            'uses' => 'HCPagesController@apiRestore',
        ]);
        Route::post('merge', [
            'as' => 'api.v1.pages.merge',
            'middleware' => [
                'acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_create',
                'acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_update',
            ],
            'uses' => 'HCPagesController@apiMerge',
        ]);
        Route::delete('force', [
            'as' => 'api.v1.pages.force.multi',
            'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_force_delete'],
            'uses' => 'HCPagesController@apiForceDelete',
        ]);

        Route::group(['prefix' => '{id}'], function() {
            Route::get('/', [
                'as' => 'api.v1.pages.single',
                'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_list'],
                'uses' => 'HCPagesController@apiShow',
            ]);
            Route::put('/', [
                'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_update'],
                'uses' => 'HCPagesController@apiUpdate',
            ]);
            Route::delete('/', [
                'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_delete'],
                'uses' => 'HCPagesController@apiDestroy',
            ]);

            Route::put('strict', [
                'as' => 'api.v1.pages.update.strict',
                'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_update'],
                'uses' => 'HCPagesController@apiUpdateStrict',
            ]);
            Route::post('duplicate', [
                'as' => 'api.v1.pages.duplicate',
                'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_create'],
                'uses' => 'HCPagesController@apiDuplicate',
            ]);
            Route::delete('force', [
                'as' => 'api.v1.pages.force',
                'middleware' => ['acl-apps:api_v1_interactivesolutions_honeycomb_pages_pages_force_delete'],
                'uses' => 'HCPagesController@apiForceDelete',
            ]);
        });
    });
});


