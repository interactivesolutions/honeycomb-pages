<?php

Route::get('pages/{year?}/{month?}/{day?}/{slug?}', ['middleware' => ['web'], 'as' => 'pages', 'uses' => 'HCPagesFrontEndController@showData']);
