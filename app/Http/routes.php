<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('emailtest', function () {
    Mail::send('emails.welcome', [], function($message) {
        echo Config::get('mail.host');
        $message->to('joe@example.com','John Doe');
        $message->subject('Welcome');
    });
});