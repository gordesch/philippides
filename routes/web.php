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
Route::post('person/{person}/subscribe', 'PersonController@subscribe')->name('person.subscribe');
Route::post('person/{person}/unsubscribe', 'PersonController@unsubscribe')->name('person.unsubscribe');

Route::resource('broadcast_list', 'BroadcastListController', ['except' => ['edit']]);
Route::post('broadcast_list/{broadcast_list}/subscribe', 'BroadcastListController@subscribe')->name('broadcast_list.subscribe');
Route::post('broadcast_list/{broadcast_list}/unsubscribe', 'BroadcastListController@unsubscribe')->name('broadcast_list.unsubscribe');

Route::resource('sending', 'SendingController', ['except' => ['edit']]);
Route::post('sending/{sending}/send', 'SendingController@send')->name('sending.send');

// Webhooks

Route::get('webhooks/sms/receive', 'NexmoWebhookController@receive');
Route::get('webhooks/sms/delivery_receipt', 'NexmoWebhookController@delivery_receipt');

// Auth

Auth::routes();
