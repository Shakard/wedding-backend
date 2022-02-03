<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\DocumentUploadedController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Auth;

//Web Services
/*Route::get('books', [LibroController::class, 'getBooks']);
Route::post('store-document', [LibroController::class, 'storeDocument']);
Route::get('strategies', [MethodologicalStrategyController::class, 'getStrategies']);
Route::get('bibliography_by_pea/{pea}', [PeaController::class, 'getBibliographiesByPea']);
Route::put('bibliography/{pea}', [PeaController::class, 'updateBibliography']);
//end of web services*/

Route::group(['namespace' => 'Web', 'as' => 'web.'], function () {

    /** Login */
    Route::get('/', 'WebController@login')->name('login');
    Route::get('/sair', 'WebController@logout')->name('logout');
});

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {

        // Router Dashboard    
        Route::get('/', 'DashboardController@index')->name('dashboard.index');

        // Router User
        /*Route::get('/users', 'UserController@index')->name('users.index');
    Route::get('/users/create', 'UserController@create')->name('users.create');
    Route::post('/users/store', 'UserController@store')->name('users.store');
    Route::get('//users/{id}/show', 'UserController@show')->name('users.show');
    Route::get('/users/{id}/edit', 'UserController@edit')->name('users.edit');
    Route::post('/users/{id}/edit', 'UserController@postUpdate')->name('users.edit');
    Route::get('/users/{id}/destroy', 'UserController@destroy')->name('users.destroy');
    Route::any('users/search', 'UserController@search')->name('users.search');*/

        // Router Studants
        Route::any('studants/search', 'StudantController@search')->name('studants.search');
        Route::post('/studants/{id}/edit', 'StudantController@postUpdate')->name('studants.postupdate');
        Route::get('/studants/{id}/destroy', 'StudantController@destroy')->name('studants.destroy');
        Route::resource('studants', 'StudantController');

        // Router Borroweds
        Route::any('borroweds/search', 'BorrowedController@search')->name('borroweds.search');
        Route::get('borroweds/search/libros', 'BorrowedController@searchLibros')->name('borroweds.searchlibros');
        Route::get('borroweds', 'BorrowedController@index')->name('borroweds.index');
        Route::get('borroweds/create', 'BorrowedController@create')->name('borroweds.create');
        Route::post('borroweds/store', 'BorrowedController@store')->name('borroweds.store');
        Route::get('/borrowed/{id}/destroy', 'BorrowedController@destroy')->name('borroweds.destroy');

        // Router Libros
        Route::any('libros/search', 'LibroController@search')->name('libros.search');
        Route::any('libros/searchLawyer', 'LibroController@searchLawyer')->name('libros.searchLawyer');
        Route::any('libros/searchByCategory', 'LibroController@searchByCategory')->name('libros.searchByCategory');
        Route::any('libros/searchLawyerByCategory', 'LibroController@searchLawyerByCategory')->name('libros.searchLawyerByCategory');
        Route::any('libros/searchByStatus', 'LibroController@searchByStatus')->name('libros.searchByStatus');
        Route::get('libros/download/{file}', 'LibroController@download')->name('libros.download');
        Route::post('/libros/{id}/edit', 'LibroController@postUpdate')->name('libros.postupdate');
        Route::post('/libros', 'LibroController@store')->name('libros.store');
        Route::get('/libro/{id}/destroy', 'LibroController@destroy')->name('libros.destroy');
        Route::resource('libros', 'LibroController');

        // Router Categories
        Route::any('categories/search', 'CategoryController@search')->name('categories.search');
        Route::get('/categories/{module}', 'CategoryController@getHome')->name('categories.home');
        Route::get('/category/{id}/delete', 'CategoryController@getDelete')->name('categories_delete');
        Route::resource('categories', 'CategoryController');

        //UploadPage
        Route::get('/admin/uploadpage', [PageController::class, 'uploadpage']);
        Route::post('/uploadproduct', [PageController::class, 'store']);
        Route::get('/show', [PageController::class, 'show']);
        Route::get('/download/{file}', [PageController::class, 'download']);
        Route::get('/view/{is}', [PageController::class, 'view']);
        Route::resource('pages', 'PageController');

        //Notifications
        Route::get('/send-document-uploaded', [DocumentUploadedController::class, 'sendDocumentUploadedNotification']);
        Route::get('/send-approved', [DocumentUploadedController::class, 'sendNotificationApproved']);
        Route::get('/send-denied', [DocumentUploadedController::class, 'sendNotificationDenied']);


        //Roles and Permissions
        Route::group(['middleware' => ['auth']], function () {

            Route::resource('users', UserController::class);
            Route::resource('roles', RoleController::class);
            Route::resource('products', ProductController::class);
            Route::get('change-password', [ChangePasswordController::class, 'index']);
            Route::post('change-password', [ChangePasswordController::class, 'changePassword'])->name('change.password');
        });
    });


Auth::routes();
