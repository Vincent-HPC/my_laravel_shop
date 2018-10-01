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

// HomePage
Route::get('/', 'MerchandiseController@indexPage');


// User
Route::group(['prefix' => 'user'], function(){
  // User Auth
  Route::group(['prefix' => 'auth'], function(){
      Route::get('/sign-up', 'UserAuthController@signUpPage');
      Route::post('/sign-up', 'UserAuthController@signUpProcess');
      
      Route::get('/sign-in','UserAuthController@signInPage');
      Route::post('/sign-in','UserAuthController@signInProcess');
      Route::get('/sign-out','UserAuthController@signOut');

  });
});


// Merchandise
Route::group(['prefix' => 'merchandise'] , function(){
  // 商品清單檢視
  Route::get('/', 'MerchandiseController@merchandiseListPage');

  //商品資料新增
  Route::get('/create', 'MerchandiseController@merchandiseCreateProcess')
      ->middleware(['user.auth.admin']);

  //商品管理清單檢視
  Route::get('/manage', 'MerchandiseController@merchandiseManageListPage')
      ->middleware(['user.auth.admin']);

  //指定商品
  Route::group(['prefix' => '{merchandise_id}'], function(){
    // 商品單品檢視
    Route::get('/', 'MerchandiseController@merchandiseItemPage')
        ->where([
          'merchandise_id' => '[0-9]+',
        ]);

    Route::group(['middleware' => ['user.auth.admin']], function(){
      // 商品單品編輯頁面檢視
      Route::get('/edit', 'MerchandiseController@merchandiseItemEditPage');
      // 商品單品資料修改
      Route::put('/', 'MerchandiseController@merchandiseItemUpdateProcess');
    });
    // 購買商品
    Route::post('/buy', 'MerchandiseController@merchandiseItemBuyProcess')
        ->middleware(['user.auth']);
  });
});

// 交易
Route::get('/transaction', 'TransactionController@transactionListPage')
    ->middleware(['user.auth']);
