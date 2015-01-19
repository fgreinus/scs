<?php

Route::get('/login', array(
    'as'    => 'showLogin',
    'uses'  => 'UserController@showLogin',
));

Route::post('/login', array(
    'as'    => 'doLogin',
    'uses'  => 'UserController@doLogin',
));

Route::any('/logout', array(
    'as'    => 'doLogout',
    'uses'  => 'UserController@doLogout',
));


Route::group(array('before' => 'auth'), function()
{
    Route::get('/overview', [
	    'uses' => 'EntryController@overview',
	    'as' => 'overview'
    ]);

    Route::get('/entry/create', [
        'uses' => 'EntryController@create',
        'as'   => 'entry_create'
    ]);

    Route::get('/entry/changestate/{id}/{state}', [
        'uses' => 'EntryController@changeState',
        'as' => 'entry_changestate'
    ]);

    Route::get('/entry/delete/{id}', [
        'uses' => 'EntryController@remove',
        'as'   => 'entry_remove'
    ]);

    Route::post( '/entry/save/{id}', [
        'uses' => 'EntryController@save',
        'as'   => 'entry_save'
    ] );

    Route::post('/entry/new', [
        'uses' => 'EntryController@doCreate',
        'as' => 'entry_new'
    ]);

    Route::get('/entry/{id}', [
        'uses' => 'EntryController@detail',
        'as'   => 'entry_detail'
    ]);

    Route::get('/search', [
        'uses' => 'SearchController@index',
        'as' => 'search'
    ]);

    Route::group(['before' => 'isAdmin', 'prefix' => 'admin'], function() {

        Route::get( '/', [
            'uses' => 'AdminController@overview',
            'as'   => 'admin',
        ] );

        Route::get('/roles', [
            'uses' => 'AdminController@roles',
            'as'   => 'admin_roles',
        ]);

        Route::post('/roles', [
            'uses' => 'AdminController@saveRoles',
            'as' => 'admin_roles_save'
        ]);

        Route::post('/user-roles/save/{userId}', [
            'uses' => 'AdminController@rolesSave',
            'as'   => 'admin_userroles_save'
        ]);

    });

	Route::get('/', function() {
		return Redirect::route('overview');
	});
});