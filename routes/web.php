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

Route::get('/', array('as' => 'welcome', function () {
    return view('welcome');
}));

Route::resource('person', 'PersonController', ['except' => ['edit']]);
Route::post('person/{person}/check_mobile_phone', 'PersonController@checkMobilePhone')->name('person.check_mobile_phone');

Route::resource('broadcast_list', 'BroadcastListController', ['except' => ['edit']]);

Route::resource('broadcast_message', 'BroadcastMessageController', ['except' => ['edit']]);
Route::post('broadcast_message/{broadcast_message}/send', 'BroadcastMessageController@send')->name('broadcast_message.send');

Route::resource('broadcast_list.list_subscriber', 'ListSubscriberController', ['only' => ['create', 'store', 'destroy']]);
Route::post('list_subscriber', 'ListSubscriberController@store')->name('list_subscriber.store');

// Webhooks

Route::get('webhooks/sms/receive', 'NexmoWebhookController@receive');
Route::get('webhooks/sms/delivery_receipt', 'NexmoWebhookController@delivery_receipt');

// Auth

Auth::routes();
