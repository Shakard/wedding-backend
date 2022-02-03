<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChairController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LibroController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\ProductController;

//Register route
Route::post('register', [AuthController::class, 'register']);
//Login route
Route::post('login', [AuthController::class, 'login']);
//Download Document route
Route::get('download/{file}', [LibroController::class, 'downloadDocument']);


Route::middleware('auth:sanctum')->group(function () {

    //Logout route
    Route::get('logout', [AuthController::class, 'logout']);

    //Categories routes
    Route::get('categories', [CategoryController::class, 'getCategories']);

    //Products routes
    Route::post('product/add', [ProductController::class, 'storeProduct']);
    Route::get('products', [ProductController::class, 'getProducts']);
    Route::get('product/{product}', [ProductController::class, 'getProductById']);
    Route::post('product/{product}/update', [ProductController::class, 'updateProduct']);
    Route::delete('product/{product}/delete', [ProductController::class, 'deleteProduct']);

    //Documents routes
    Route::get('documents', [LibroController::class, 'getDocuments']);
    Route::post('document/add', [LibroController::class, 'storeDocument']);
    Route::get('document/{document}', [LibroController::class, 'getDocumentById']);
    Route::post('document/{document}/update', [LibroController::class, 'updateDocument']);
    Route::delete('document/{document}/delete', [LibroController::class, 'destroyDocument']);
    Route::post('search', [LibroController::class, 'searchByDescription']);

    //Users routes
    Route::get('users', [UserController::class, 'getUsers']);
    Route::get('guests', [UserController::class, 'getGuests']);
    Route::post('change-password', [ChangePasswordController::class, 'changePasswordApi']);
    Route::get('logged-user', [UserController::class, 'loggedUser']);    
    Route::put('user/{user}' , [UserController::class, 'update2']);
    Route::delete('user/{user}' , [UserController::class, 'destroy3']);
    Route::post('search-by-parameters', [UserController::class, 'searchByParameters']);
    Route::post('import-users', [UserController::class, 'importUsers']);


    //Tables Routes
    Route::get('tables', [TableController::class, 'getTables']);
    Route::get('group-tables', [TableController::class, 'getGroupedTablesChairs']);
    Route::post('table/add', [TableController::class, 'storeTable']);
    Route::put('table/{table}', [TableController::class, 'updateTable']);
    Route::delete('table/{table}' , [TableController::class, 'destroy']);
    Route::post('store-table-by-number', [TableController::class, 'storeTableByNumber']);

    //Chair routes
    Route::post('chair/add', [ChairController::class, 'storeChair']);
    Route::get('chairs', [ChairController::class, 'getChairs']);
    Route::put('chair/{chair}', [ChairController::class, 'updateChair']);
    Route::put('add-user/{chair}', [ChairController::class, 'addUser']);
    Route::get('chair-user', [ChairController::class, 'getChairsUsers']);    
    Route::get('chairs-by-table/{table}', [ChairController::class, 'getChairsByTable']);    
    Route::post('store-chair-by-number', [ChairController::class, 'storeChairByNumber']);

    
});







/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user(); 

});*/
