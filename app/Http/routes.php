<?php

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
Route::auth();

    //////////////////
    //    LOGIN     //
    //////////////////
    Route::get('/', function () {
        return view('layouts.login');
    });

    Route::get('welcome', function () {
        return view('layouts.login');
    });

    Route::get('finish', function () {
        return view('layouts.finish');
    });

    //////////////////
    //   EMPLOYEE   //
    //////////////////
    Route::get('welcome/{guid}', ['as' => 'welcome', 'uses' => 'EmployeeFormController@bind']);
    Route::post('welcome/{guid}/store', 'EmployeeFormController@store');
    Route::post('welcome/{guid}/upload/file', 'EmployeeFormController@uploadFile');
    Route::get('welcome/{guid}/delete/file/{attachment_id}', 'EmployeeFormController@deleteFile');
    Route::get('welcome/{guid}/attachments', 'EmployeeFormController@attachments');
    Route::post('welcome', 'EmployeeFormController@login');
    Route::get('hcm/{token}', 'EmployeeFormController@hcm');
    Route::get('employees/{guid}/done', ['as' => 'hcmDone', 'uses' => 'EmployeeFormController@hcmDone']);
    Route::post('employees/{guid}/failed', ['as' => 'hcmFailed', 'uses' => 'EmployeeFormController@hcmFailed']);

    //////////////////
    //  ADMIN AUTH  //
    //////////////////
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {

        Route::get('/', ['as' => 'home', function () {
            if(!Auth::check()){
                return view('auth.login');
            }else{
                return redirect()->action('Admin\EmployeeController@index');
            }
        }]);

        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');

        Route::resource('employees', 'EmployeeController');
        Route::get('employees/{id}/pdf', ['as' => 'pdf', 'uses' => 'EmployeeController@pdf']);
		Route::get('employees/{id}/email', ['as' => 'email', 'uses' => 'EmployeeController@email']);

        Route::resource('users', 'UserController');
        Route::get('myprofile', ['as' => 'myprofile', 'uses' => 'UserController@myprofile']);
        Route::get('reset', ['as' => 'profile.reset', 'uses' =>'UserController@reset']);
        Route::post('password/reset', ['as' => 'profile.password', 'uses' =>'UserController@resetPassword']);

        ///////////////////////
        //    BULK ACTIONS   //
        ///////////////////////
        Route::post('roles/bulk', ['as' => 'admin.roles.bulk', 'uses' =>'RoleController@bulk']);
        Route::post('permissions/bulk', ['as' => 'admin.permissions.bulk', 'uses' =>'PermissionController@bulk']);
        Route::post('users/bulk', ['as' => 'admin.users.bulk', 'uses' =>'UserController@bulk']);
        Route::post('employees/bulk', ['as' => 'admin.employees.bulk', 'uses' =>'EmployeeController@bulk']);

        ///////////////////////
        //   SEARCH ACTION   //
        ///////////////////////
        Route::post('roles/search', ['as' => 'admin.roles.search', 'uses' =>'RoleController@search']);
        Route::post('permissions/search', ['as' => 'admin.permissions.search', 'uses' =>'PermissionController@search']);
        Route::post('users/search', ['as' => 'admin.users.search', 'uses' =>'UserController@search']);
        Route::post('employees/search', ['as' => 'admin.employees.search', 'uses' =>'EmployeeController@search']);

        //////////////////////////////////////////////
        // ACTIVATE/DEACTIVATE STATUS TOGGLE ACTION //
        //////////////////////////////////////////////
        Route::get('users/{managers}/status', ['as' => 'admin.users.status', 'uses' =>'UserController@status']);
        Route::get('employees/{employees}/status', ['as' => 'admin.employees.status', 'uses' =>'EmployeeController@status']);

        Route::post('employees/bulk', ['as' => 'admin.employees.bulk', 'uses' =>'EmployeeController@bulk']);
    });
