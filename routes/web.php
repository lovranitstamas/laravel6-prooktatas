<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/social/{provider}', 'SocialAuthController@redirectToProvider')->name('social.login');
Route::get('/social/{provider}/callback', 'SocialAuthController@handleProviderCallback');


Route::namespace('Admin')->name('admin.')->prefix('admin')->group(function () {
    Route::namespace('Auth')->group(function () {
        Route::get('/login', 'LoginController@showLoginForm')->name('login.create');    //5.óra
        Route::post('/login', 'LoginController@login')->name('login.store');            //5.óra
        Route::post('/logout', 'LoginController@logout')->name('logout');               //5.óra
        Route::get('/logout', 'LoginController@logout')->name('logout');               //5.óra
    });

    Route::middleware('admin_auth')->group(function () {
        //name prefix
        Route::get('/', 'DashboardController@index')->name('dashboard');                 //5.óra
        Route::get('/dropdown1', 'DropdownController@dropdown1')->name('dropdown1');
        Route::get('/dropdown2', 'DropdownController@dropdown2')->name('dropdown2');

        Route::get('/customers', 'CustomersController@index')->name('customers.index');

        Route::get('/customer/registration', 'CustomersController@create')->name('customers.create');
        Route::post('/customer/registration', 'CustomersController@store')->name('customers.store');

        Route::get('/customer/{id}/modify', 'CustomersController@edit')->name('customers.edit');
        Route::put('/customer/{id}/modify', 'CustomersController@update')->name('customers.update');


        Route::get('/post', 'PostController@index')->name('posts.index');
        Route::get('/post/registration', 'PostController@create')->name('posts.create');
        Route::post('/post/registration', 'PostController@store')->name('posts.store');
        Route::get('/post/{postId}/modify', 'PostController@edit')->name('posts.edit');
        Route::put('/post/{postId}/modify', 'PostController@update')->name('posts.update');
        Route::get('/post/{postId}', 'PostController@show')->name('posts.show');
    });
});

//Customer auth routes
Route::get('/login', 'CustomersAuthController@create')->name('login.create');                       //4.óra
Route::post('/login', 'CustomersAuthController@store')->name('login.store');                        //4.óra


//Customer routes
Route::middleware('customer_auth')->group(function () {

    Route::get('/customers', 'CustomersController@index')->name('customers.index');                 //3.óra
    Route::get('/customer/{id}', 'CustomersController@show')->name('customers.show');               //3.óra
    Route::get('/customer/{id}/modify', 'CustomersController@edit')->name('customers.edit');        //4.óra
    Route::put('/customer/{id}/modify', 'CustomersController@update')->name('customers.update');    //4.óra
    Route::delete('/customer/{id}', 'CustomersController@destroy')->name('customers.destroy');      //4.óra
    Route::delete('/customer/{id}/json', 'CustomersController@destroyWithJson')->name('customers.destroyDestroyWithJson'); //4.óra


    Route::get('/indexByFilter', 'CustomersController@indexByFilter')->name('customers.indexByFilter'); //4.óra
    Route::get('/indexByFilterDateResult', 'CustomersController@indexByFilterDateResult')
        ->name('customers.indexByFilterDateResult'); //4.óra
    Route::get('/indexByFilterSearch', 'CustomersController@indexByFilterSearch')->name('customers.indexByFilterSearch'); //4.óra


    Route::delete('/logout', 'CustomersAuthController@destroy')->name('login.destroy'); //4.óra


    Route::get('/post/registration', 'PostController@create')->name('posts.create');       //6.óra
    Route::post('/post/registration', 'PostController@store')->name('posts.store');        //6.óra

    Route::get('/post/{postId}/modify', 'PostController@edit')->name('posts.edit');        //6.óra
    Route::put('/post/{postId}/modify', 'PostController@update')->name('posts.update');    //6.óra

    Route::get('/post/ownPosts', 'PostController@ownPosts')->name('posts.ownPosts');        //7.óra
    Route::delete('/post/{id}/json', 'PostController@destroyDestroyWithJson')
        ->name('ownPosts.destroyDestroyWithJson');                                          //7.óra

    Route::get('/post/{postId}', 'PostController@show')->name('posts.show');     //7.óra !!!!!!!!!!!!!! ki
    //Route::post('/post/{postId}/comment/', 'CommentsController@store')->name('posts.comment.store'); //7. óra
    Route::post('/post/{type}/{id}/comment/', 'CommentsController@store')->name('posts.comment.store');


    Route::get('/post/{customerId?}', 'PostController@index')->name('posts.index');        //6.óra !!!!!!!!!!!! ki


});

Route::get('/post/{postId}', 'PostController@show')->name('posts.show');     //7.óra !!!!!!!!!!!!!!!!
Route::get('/post/{customerId?}', 'PostController@index')->name('posts.index');        //6.óra !!!!!!!!!!!

Route::get('/registration', 'CustomersController@create')->name('customers.create'); //3.óra
Route::post('/registration', 'CustomersController@store')->name('customers.store'); //3.óra

Route::get('/whereHas', 'PostController@customerWhoUsedLabelNumber2');


//Route::delete('/fiok-torles');

Route::get('/statistics', 'StatisticsController@index')->name('statistics');
Route::get('/statistics/lastThreeCustomer', 'StatisticsController@lastThreeCustomer')->name('statistics.lastThreeCustomer');
Route::get('/statistics/mostCommentingCustomer', 'StatisticsController@mostCommentingCustomer')->name('statistics.mostCommentingCustomer');
Route::get('/statistics/customerReceivedMostComments', 'StatisticsController@customerReceivedMostComments')->name('statistics.customerReceivedMostComments');
Route::get('/statistics/mostCommentedNote', 'StatisticsController@mostCommentedNote')->name('statistics.mostCommentedNote');
Route::get('/statistics/mostCommentedTag', 'StatisticsController@mostCommentedTag')->name('statistics.mostCommentedTag');

Route::get('/testQueries', 'CustomersController@index')->name('customers.index2'); //3.óra
Route::get('/testCustomerRegister', 'CustomersController@newCustomer')->name('customers.newCustomer'); //3.óra

Route::get('/', 'TestController@index')->name('index'); //2. óra
Route::post('/pageRegister', 'TestController@register')->name('test.register'); //2. óra
Route::get('/{page}', 'TestController@show')->name('test.show'); //2. óra


//Route::resources('bla/bla', 'blaController', ['except'=> 'show']);
