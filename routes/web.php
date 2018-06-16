<?php

// Route::get('/', 'HomeController@welcome')->name('welcome');

// Route::group(['middleware' => 'auth'], function () {
//     Route::get('user/profile', 'Auth\ProfileController@index')->name('profile');
//     Route::post('user/profile', 'Auth\ProfileController@store')->name('profile-save');

//     /**
//      * Event related routes
//      */
//     $eventsController = "\App\Modules\Event\Http\Controllers\EventsController";
//     Route::get('events', "{$eventsController}@index")->name('events');
//     Route::get('events/add', "{$eventsController}@add")->name('event-add');
//     Route::post('events/save', "{$eventsController}@store")->name('event-save');
//     Route::get('events/view/{event}', "{$eventsController}@view")->name('event-view');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'HomeController@index');
Route::get('/news/{id}','New_detailController@getNewsById');
Route::get('/recoms/{id}','Recom_detailController@index');
Route::post('/paypal','PaymentController@payWithpaypal');
Route::get('/admin',function(){
    return view('admin/index');
});

Route::get('/view/login','UserController@viewLogin');
Route::post('/login','UserController@login')->name('login');
Route::get('/login',function(){
    return redirect('/');
});

Route::group(['prefix' => 'admin','middleware' => 'isAdmin'], function () {
//    Auth::routes();

    Route::get('/', 'HomeController@admin');

    Route::get('/logout','UserController@logout');

    // Routes use for user management
    Route::group(['prefix' => 'user'], function() {

        // Show list user
        Route::get('/', 'UserController@managerUser');

        Route::get('/view/edit/{id}','UserController@viewEditUser');
        // // Create user
        Route::post('/create', 'UserController@createUser')->name('create-user');
        Route::get('/create',function(){
            return redirect()->back();
        });

        // // Update user
        // Route::get('/update/{id}', 'Admin\UserController@edit')->name('admin.user.edit');
        // Route::patch('/update/{id}', 'Admin\UserController@update')->name('admin.user.update');

        // // Delete user
        Route::get('/delete/{id}', 'UserController@destroy')->name('delete-user');
    });
    Route::group(['prefix' => 'recom'], function() {

        // Show list user
        Route::get('/', 'RecomController@index');
    });
    Route::group(['prefix' => 'news'], function() {

        // Show list user
        Route::get('/', 'NewController@index');
    });
    Route::group(['prefix' => 'service'], function() {

        // Show list user
        Route::get('/',function(){
            return view('admin/service/index');
        });
    });

});