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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware'=>'auth'], function () {

    Route::resource('qrcodes', 'QrcodeController')->except(['show']);
    Route::resource('roles', 'RoleController');
    Route::resource('transactions', 'TransactionController')->except(['show']);
    Route::resource('users', 'UserController');    
    Route::resource('accounts', 'AccountController')->except(['show']);    
    Route::get('/accounts/show/{id?}', 'AccountController@show')->name('accounts.show');
    Route::resource('accountHistories', 'AccountHistoryController');
    Route::get('/transactions/cetak-pdf', 'TransactionController@cetakPdf')->name('transactions.cetak-transaksi');  
    
});

Route::post('/accounts/apply_for_payout', 'AccountController@apply_for_payout')->name('accounts.apply_for_payout');
Route::post('/accounts/mark_as_paid', 'AccountController@mark_as_paid')->name('accounts.mark_as_paid');

Route::get('/account/create', 'AccountController@create')
->name('accounts.create')->middleware('checkadmin');

Route::get('/accountHistories/create', 'AccountHistoryController@create')
->name('accountHistories.create')->middleware('checkadmin');

// route ini dapat diakses walaupun sudah di log out
Route::get("/qrcodes/{id}", 'QrcodeController@show')->name('qrcodes.show');

Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');
Route::post('/qrcodes/show_payment_page', 'QrcodeController@show_payment_page')->name('qrcodes.show_payment_page');

Route::get('/transactions/{id}', 'TransactionController@show')->name('transactions.show');