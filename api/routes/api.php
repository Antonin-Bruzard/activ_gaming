<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API ROUTES.
|--------------------------------------------------------------------------
| Structure:
|  - Non authenticated      (Route)
|  - Authenticated          (Route)
|
| Include:
|  - Throttle                (Middleware)
|  - Authorization           (Middleware)
|
| Documentation:
|  >Throttle (default: 60,1)
|   Throttle is a middleware take two parameters.
|   First: is the maximum requests user can attempt in 1 minutes.
|   Second: is the decay time. How much time user have to wait before be authorized back.
|
|   So. For example: throttle:60.10
|   If user attempt 60 request in one minutes.
|   He will be block for 10 minutes.
|
|  >Authorization
|   This middleware allow/deny routes or methods.
*/


Route::group(['prefix' => '/auth', ['middleware' => 'throttle:25,5']], function() {
    Route::post('/register', 'Auth\RegisterController@register');
    Route::post('/login', 'Auth\LoginController@login');
});

/*
|--------------------------------------------------------------------------
| Authenticated routes.
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => 'jwt.auth'], function() {
    /*
    |---------------------------
    | Misc resources.
    |---------------------------
    */
    Route::resources([
        'users' => 'UserController',
        //'categories' => 'CategoryController',
        'files' => 'FileController',
        // 'sliders' => 'SliderController',
    ]);

    /*
    |---------------------------
    | Users.
    |---------------------------
    */
    Route::get('/me', 'MeController@index');
    Route::get('/auth/logout', 'Auth\LogoutController@logout');

    /*
    |---------------------------
    | Articles.
    |---------------------------
    */
    Route::get('/articles/unpublished', 'ArticleController@unpublished')->name('articles.unpublished');
    Route::post('/articles/create', 'ArticleController@create')->name('articles.create');
    Route::put('/articles/{article}', 'ArticleController@update')->name('articles.update');
    Route::delete('/articles/{article}', 'ArticleController@destroy')->name('articles.destroy');

    /*
    |---------------------------
    | Networks.
    |---------------------------
    */
    Route::post('/networks/create', 'NetworkController@create')->name('networks.create');
    Route::put('/networks/{network}', 'NetworkController@update')->name('networks.update');
    Route::delete('/networks/{network}', 'NetworkController@destroy')->name('networks.destroy');

    /*
    |---------------------------
    | Categories.
    |---------------------------
    */
    Route::get('/categories', 'CategoryController@index')->name('categories.index');
    Route::post('/categories/create', 'CategoryController@create')->name('categories.create');
    Route::get('/categories/{slug}/all', 'CategoryController@showCategoryArticles')->name('categories.articles.all');
    Route::get('/categories/{slug}/unpublished', 'CategoryController@showCategoryArticlesUnpublished')->name('categories.articles.unpublished');
    Route::get('/categories/{slug}/deleted', 'CategoryController@showCategoryArticlesDeleted')->name('categories.articles.deleted');
});

/*
|--------------------------------------------------------------------------
| Non authenticated routes.
|--------------------------------------------------------------------------
|
| Route without authentication needed.
| That's route use throttle middleware (see top of this page).
|
*/
Route::group(['middleware' => 'throttle:60.1'], function() {
    /*
    |---------------------------
    | Sliders.
    |---------------------------
    */
    Route::get('/sliders', 'SliderController@index')->name('sliders.index');

    /*
    |---------------------------
    | Articles.
    |---------------------------
    */
    Route::get('/articles', 'ArticleController@index')->name('articles.index');
    Route::get('/articles/{article}', 'ArticleController@show')->name('articles.show');

    /*
    |---------------------------
    | Networks.
    |---------------------------
    */
    Route::get('/networks', 'NetworkController@index')->name('networks.index');

    /*
    |---------------------------
    | Categories.
    |---------------------------
    */
    Route::get('/categories/{slug}/published', 'CategoryController@showCategoryArticlesPublished')->name('categories.articles.published');
});