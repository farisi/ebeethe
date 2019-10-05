<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix'=>'companies','as'=>'api.companies.'],function(){
    route::get('/',['uses'=>'Api\CompaniesController@index'])->name('index');
    route::get('/findbytag',['uses'=>'Api\CompaniesController@findbytag'])->name('findbytag');
});

Route::group(['prefix'=>'taxes','as'=>'api.taxes.'],function(){
    route::get('/findnotif',['uses'=>'Api\TaxesController@findnotif'])->name('findnotif');
});

Route::group(['prefix'=>'company_categories','as'=>'api.company_categories.'],function(){
    route::get('/findbytag',['uses'=>'Api\CompanyCategoriesController@findbytag'])->name('findbytag');
});