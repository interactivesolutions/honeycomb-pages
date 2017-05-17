<?php

Route::get('pages/{year?}/{month?}/{day?}/{slug?}', ['middleware' => ['web'], 'uses' => 'HCPagesFrontEndController@showData']);
