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

Route::get('/', 'UserController@login');
Route::get('/register','UserController@show')->name('register');
Route::post('/register','UserController@register');
Route::post('/','UserController@register');
Route::get('/login','UserController@login')->name('login');
Route::get('/logout','UserController@logout')->name('logout');
Route::post('/ServerValidate','UserController@loginServer');
Route::post('/ServerLoginUser','UserController@loginSuccess')->name('ServerLoginUser');
Route::post('/AddFriend','UserController@AddFriend')->name('AddFriend');
Route::post('/state','UserController@state')->name('state');
Route::post('/follow','PageController@follow')->name('follow');
Route::post('/unfollow','PageController@unfollow')->name('unfollow');
Route::post('/followgroup','GroupController@follow')->name('followgroup');
Route::post('/unfollowgroup','GroupController@unfollow')->name('unfollowgroup');
Route::get('/setting','UserController@setting')->name('setting');
Route::get('/about','UserController@about')->name('setting');
Route::get('/createpage','UserController@page');
Route::get('/creategroup','UserController@group');
Route::get('/createproduct','UserController@product');
Route::get('/about','UserController@about')->name('setting');
Route::get('/aboutform','UserController@aboutform');
Route::get('/pageform','UserController@pageform');
Route::get('/groupform','UserController@groupform');
Route::get('/productform','UserController@productform');
Route::post('/productform','UserController@storeform');
Route::post('/AcceptFriend','UserController@AcceptFriend')->name('AcceptFriend');
Route::post('/saveMessage','MessageController@saveMessage')->name('saveMessage');
Route::post('/waiting','MessageController@waiting')->name('waiting');
Route::post('/refuseFriend','UserController@refuseFriend')->name('refuseFriend');
Route::post('/RemoveFriend','UserController@RemoveFriend')->name('RemoveFriend');
Route::get('/welcomepost{post}','ProfileController@welcome')->name('welcome');
Route::get('/timeline','ProfileController@timeline')->name('timeline');
Route::get('/page{id}','ProfileController@page')->name('page');
Route::get('/group{id}','ProfileController@group')->name('group');
Route::get('/productinfo{id}','ProductController@productinfo')->name('productinfo');
Route::get('/storeinfo','ProductController@storeinfo')->name('storeinfo');
Route::get('/product{id}','ProductController@product')->name('product');
Route::get('/grouppost{id}/{post}','ProfileController@grouppost')->name('group');
Route::get('/pagepost{id}/{post}','ProfileController@pagepost')->name('group');
Route::get('/welcome2','ProfileController@frame')->name('welcome2');
Route::get('/friends','FrameController@friends')->name('friends');
Route::get('/message/{id}','MessageController@message')->name('message');
Route::post('/welcome','ProfileController@welcomeUpdate')->name('welcome');
Route::post('/saveDetails','ProfileController@saveDetails')->name('saveDetails');
Route::post('/makepage','PageController@makepage')->name('makepage');
Route::post('/makegroup','GroupController@makegroup')->name('makegroup');
Route::post('/post','ProfileController@post')->name('post');
Route::post('/share','ProfileController@share')->name('share');
Route::post('/page_post','PageController@post')->name('page_post');
Route::post('/group_post','GroupController@post')->name('group_post');
Route::post('/page_admin','PageController@admin')->name('page_admin');
Route::post('/like','ProfileController@like')->name('like');
Route::post('/comment','ProfileController@comment')->name('comment');
Route::post('/RemoveNotification','FrameController@RemoveNotification')->name('RemoveNotification');
Route::get('/profile{id}/{post}','ProfileController@profile')->name('profile');
Route::post('/login','UserController@login');
Route::get('/version2','UserController@version2');
Route::get('/discover', 'UserController@img')->name('home');
Route::get('/discoverPages', 'PageController@img')->name('pages');
Route::get('/discoverGroups', 'GroupController@img')->name('groups');
Route::post('/acceptadd', 'GroupController@add')->name('acceptadd');
Route::post('/refuseadd', 'GroupController@refuse')->name('refuseadd');
Route::post('/updateInfo','ProfileController@UpdateInfo');
Route::post('/deletePost','ProfileController@deletePost');
Route::post('/makeproduct', 'ProductController@newProduct')->name('makeproduct');
Route::post('/offer', 'ProductController@offer')->name('offer');
Route::post('/acceptoffer', 'ProductController@accept')->name('acceptoffer');
Route::post('/refuseoffer', 'ProductController@refuse')->name('refuseoffer');
Route::get('/store', 'ProductController@store')->name('store');

