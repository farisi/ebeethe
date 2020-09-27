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

Route::get('/',['uses'=>'HomeController@index'], function () {
    //return view('welcome');
})->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('dashboard');


Route::get('/init',['uses'=>'TaxesController@init','prefix'=>'taxes','as'=>'taxes.init']);
Route::get('/{id}/edit',['uses'=>'TaxesController@edit','prefix'=>'taxes','as'=>'taxes.edit']);
Route::resource('taxes','TaxesController')->except([
    'edit'
]);

Route::resource('users','UserController');


Route::group(['prefix'=>'status','as'=>'status.'],function(){
    Route::get('/','StatusController@index')->name('index');
    Route::get('/initdata','StatusController@initdata')->name('initdata');
    Route::get('/add','StatusController@create')->name('create');
    Route::get('/{id}','StatusController@edit')->name('edit');
    Route::get('/{id}/view','StatusController@view')->name('view');
    Route::post('/','StatusController@store')->name('store');
    Route::delete('/{id}','StatusController@destroy')->name('destroy');
});

Route::group(['prefix'=>'companies','as'=>'companies.'],function(){
    Route::get('/init','CompaniesController@init')->name('init');
    Route::get('/','CompaniesController@index')->name('index');
    Route::get('/add','CompaniesController@create')->name('create');
    Route::get('/{id}/edit','CompaniesController@edit')->name('edit');
    Route::get('/{id}','CompaniesController@show')->name('show');
    Route::post('/','CompaniesController@store')->name('store');
    Route::patch('/{id}','CompaniesController@update')->name('update');
    Route::delete('/{id}','CompaniesController@destroy')->name('destroy');
});


Route::get('init',['prefix'=>'problems','uses'=>'ProblemTaxes@init','as'=>'problems.init']);
Route::get('/{id}/lunasform',['prefix'=>'problems','uses'=>'ProblemTaxes@lunasform'])->name('problems.lunasform');
Route::resource('problems','ProblemTaxes');
Route::patch('/{id}/lunasexec',['prefix'=>'problems','uses'=>'ProblemTaxes@lunasexec','as'=>'problems.lunasexec']);

Route::get('init',['prefix'=>'teguran','as'=>'teguran.init','uses'=>'ReprimandLetter@init']);
Route::resource('teguran','ReprimandLetter');

Route::get('init',['prefix'=>'company_categories','uses'=>'CategoryCompaniesController@init'])->name('company_categories.init');
Route::resource('company_categories','CategoryCompaniesController');

Route::group(['prefix'=>'reports','as'=>'reports.'],function(){
    Route::get('/init','ReportsController@init')->name('init');
    Route::get('/','ReportsController@index')->name('index');
    Route::get('/pdf','ReportsController@showpdf')->name('showpdf');
});

Route::resource('commons','CommonController');
