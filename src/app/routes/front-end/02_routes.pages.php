<?php

Route::get('pages/{year?}/{month?}/{day?}/{slug?}', ['middleware' => ['web'], 'as' => 'page', 'uses' => 'HCPagesFrontEndController@showData']);
