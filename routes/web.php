<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Back Routes
|--------------------------------------------------------------------------
*/

Route::get('site-bakimda',function(){
  return view('front.offline');
});

//middleware isAdmin işlemi alt tarafta girişi kontrol ettiği için tekrardan giriş routlarını oraya yazmadık.!!
Route::prefix('admin')->name('admin.')->middleware(['isLogin'])->group(function(){    //middleware'in giriş yapmamışsa yapma işlemi.

Route::get('giriş', 'App\Http\Controllers\Back\AuthController@login')->name('login');
Route::post('giriş', 'App\Http\Controllers\Back\AuthController@loginPost')->name('login.post');

});

Route::prefix('admin')->name('admin.')->middleware(['isAdmin'])->group(function(){       //süreki admin yazmamak için tek grup haline getirdik!!
Route::get('panel', 'App\Http\Controllers\Back\Dashboard@index')->name('dashboard');
//MAKALE ROUTE'LARI:
Route::get('makaleler/silinenler','App\Http\Controllers\Back\ArticleController@trashed')->name('trashed.article');

       //burada admin. şeklinde yazmamızın sebebi alttaki routlar ile karışmamasıdır.bunuda ustte tek grup haline getirdik:)
Route::resource('makaleler', 'App\Http\Controllers\Back\ArticleController');
Route::get('/switch','App\Http\Controllers\Back\ArticleController@switch')->name('switch');
Route::get('/deletearticle/{id}','App\Http\Controllers\Back\ArticleController@delete')->name('delete.article');
Route::get('/hardDeletearticle/{id}','App\Http\Controllers\Back\ArticleController@hardDelete')->name('hard.delete.article');
Route::get('/recoverarticle/{id}','App\Http\Controllers\Back\ArticleController@recover')->name('recover.article');

//KATEGORİ ROUTE'LARI:

Route::get('/Kategoriler', 'App\Http\Controllers\Back\CategoryController@index')->name('category.index');
Route::post('/Kategoriler/create', 'App\Http\Controllers\Back\CategoryController@create')->name('category.create');
Route::get('/Kategori/status', 'App\Http\Controllers\Back\CategoryController@switch')->name('category.switch');
Route::get('/Kategori/getData', 'App\Http\Controllers\Back\CategoryController@getData')->name('category.getData');


// PAGE (SAYFA) ROUTE'LARI:

Route::get('/Sayfalar', 'App\Http\Controllers\Back\PageController@index')->name('page.index');
Route::get('/Sayfalar/Olustur', 'App\Http\Controllers\Back\PageController@create')->name('page.create');
Route::get('/Sayfalar/guncelle/{id}', 'App\Http\Controllers\Back\PageController@update')->name('page.edit');
Route::post('/Sayfalar/guncelle/{id}', 'App\Http\Controllers\Back\PageController@updatePost')->name('page.edit.post');
Route::post('/Sayfalar/Olustur', 'App\Http\Controllers\Back\PageController@post')->name('page.create.post');
Route::get('/Sayfa/sil/{id}', 'App\Http\Controllers\Back\PageController@delete')->name('page.delete');

//CONFİG ROUTE'LARI:
Route::get('/ayarlar', 'App\Http\Controllers\Back\ConfigController@index')->name('config.index');
Route::Post('/ayarlar/update', 'App\Http\Controllers\Back\ConfigController@update')->name('config.update');


//
Route::get('çikiş', 'App\Http\Controllers\Back\AuthController@logout')->name('logout');
});


/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------- -----------------------------------------------------
|
*/
Route::get('/', 'App\Http\Controllers\Front\Homepage@index')->name('homepage');
Route::get('/iletişim', 'App\Http\Controllers\Front\Homepage@contact')->name('contact');
Route::post('/iletişim', 'App\Http\Controllers\Front\Homepage@contactpost')->name('contact.post');    //sabit url olanları başa yazdık.
Route::get('/Kategori/{category}', 'App\Http\Controllers\Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}', 'App\Http\Controllers\Front\Homepage@single')->name('single');
Route::get('/{sayfa}', 'App\Http\Controllers\Front\Homepage@page')->name('page');
