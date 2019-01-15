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
Route::group(['middleware'   => ['web','auth'] ],function(){
    Route::get('/home','HomeController@home');
    Route::get('/search','SearchController@getResults');
    Route::get('/profile/{id}','ProfileController@getProfile');
    Route::post('/profile/changeProfileImage','ProfileController@changeProfileImage');
    Route::post('/profile/changeBackgroundImage','ProfileController@changeBackgroundImage');
    Route::get('user/{id}/friends','FriendController@getFriends');
    Route::get('/friends/add/{id}','FriendController@addFriend');
    Route::get('/friends/accept/{id}','FriendController@acceptFriend');
    Route::get('/friends/refuse/{id}','FriendController@refuseFriend');
    Route::get('/follow/{id}','followerController@Follow');
    Route::get('/user/followers/{id}','followerController@getFollowers');
    Route::get('/user/followed/{id}','followerController@getFolloweds'); 
    Route::get('/user/statuses/{id}','StatusController@getUserStatuses');           
    Route::post('/status/add','StatusController@addStatus');
    Route::post('/status/{id}/reply','StatusController@addReply');
    Route::get('/status/{id}/like','StatusController@Like');
    Route::get('/status/{id}/share','StatusController@shareStatus');    
    Route::get('/posts/{id}','StatusController@getPost');

    
});
Route::group(['middleware'   => ['guest'] ],function(){
    Route::get('/','HomeController@index'); 
    Route::get('/signup','AuthController@getSignUp');
    Route::post('/signup','AuthController@postSignUp');
    Route::get('/signin','AuthController@getSignIn');
    Route::post('/signin','AuthController@postSignIn');
});
Route::get('/signout','AuthController@getSignOut');