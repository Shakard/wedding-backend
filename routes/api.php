<?php

use App\Http\Controllers\Admin\CanvasElementController;
use App\Http\Controllers\Admin\CatalogueController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ChairController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LibroController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProductController;

//Register route
Route::post('register', [AuthController::class, 'register']);

//Login route
Route::post('login', [AuthController::class, 'login']);

//Web Page routes
//Update guest confirmation route
Route::post('confirmation', [UserController::class, 'updateConfirmation']);
Route::get('images', [FileController::class, 'getAllFiles']);


//post de prueba
Route::post('prueba', [UserController::class, 'updatePruba']);

//download file from gallery
Route::get('download-catalogue', [FileController::class, 'downloadFile']);


Route::middleware('auth:sanctum')->group(function () {

    //Logout route
    Route::get('logout', [AuthController::class, 'logout']);

    //Categories routes
    Route::get('categories', [CategoryController::class, 'getCategories']);

    //Files routes
    Route::post('upload-images', [FileController::class, 'storeFiles']);
    Route::delete('file/{file}', [FileController::class, 'deleteFile']);

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
    Route::any('guests', [UserController::class, 'getGuests']);
    Route::any('guests-and-table', [UserController::class, 'getGuestsWithTable']);
    Route::post('search-guests-by-filters', [UserController::class, 'searchGuestByParameters']);
    Route::any('search-guests/{filters}', [UserController::class, 'searchGuestsNames']);
    Route::post('change-password', [ChangePasswordController::class, 'changePasswordApi']);
    Route::get('logged-user', [UserController::class, 'loggedUser']);
    Route::put('user/{user}', [UserController::class, 'update2']);
    Route::delete('user/{user}', [UserController::class, 'destroy3']);
    Route::any('clear-user-table-id/{id}', [UserController::class, 'clearUserTableId']);
    Route::any('clear-all-table-id', [UserController::class, 'clearAllUsersTableId']);
    Route::any('send-users-mail', [UserController::class, 'sendUsersMail']);
    Route::any('send-users-qr', [UserController::class, 'sendUsersQr']);
    Route::post('delete-users', [UserController::class, 'deleteSelectedUsers']);
    Route::post('search-by-parameters', [UserController::class, 'searchByParameters']);
    Route::post('import-users', [UserController::class, 'importUsers']);
    Route::get('users-table', [UserController::class, 'countGuestsByTable']);
    Route::post('add-user', [UserController::class, 'storeUser']);

    //Tables Routes
    Route::get('tables', [TableController::class, 'getTables']);
    Route::get('tables-users', [TableController::class, 'getTablesAndUsers']);
    Route::get('group-tables', [TableController::class, 'getGroupedTablesChairs']);
    Route::post('table/add', [TableController::class, 'storeTable']);
    Route::put('table/{table}', [TableController::class, 'updateTable']);
    Route::delete('table/{table}', [TableController::class, 'destroy']);
    Route::post('store-table-by-number', [TableController::class, 'storeTableByNumber']);
    Route::post('update-tables', [TableController::class, 'updateTables']);
    Route::put('update-table-position', [TableController::class, 'updatePosition']);
    Route::any('reset-tables-position', [TableController::class, 'resetPosition']);

    //Chair routes
    Route::post('chair/add', [ChairController::class, 'storeChair']);
    Route::get('chairs', [ChairController::class, 'getChairs']);
    Route::get('unique-chairs', [ChairController::class, 'getChairsDropDown']);
    Route::put('chair/{chair}', [ChairController::class, 'updateChair']);
    Route::put('add-user/{chair}', [ChairController::class, 'addUser']);
    Route::get('chair-user', [ChairController::class, 'getChairsUsers']);
    Route::get('chairs-by-table/{table}', [ChairController::class, 'getChairsByTable']);
    Route::post('store-chair-by-number', [ChairController::class, 'storeChairByNumber']);

    //CanvasElement Routes
    Route::post('store-canvas-element', [CanvasElementController::class, 'storeCanvasElement']);
    Route::post('store-round-table-by-number', [CanvasElementController::class, 'storeRoundTableByNumber']);
    Route::get('tables-with-guests', [CanvasElementController::class, 'getDiningTablesWithGuests']);
    Route::post('canvas-elements-by-type', [CanvasElementController::class, 'getCanvasElementsByType']);
    Route::put('update-element-position', [CanvasElementController::class, 'updatePosition']);
    Route::put('update-element-size', [CanvasElementController::class, 'updateSize']);
    Route::any('reset-element-position', [CanvasElementController::class, 'resetPosition']);
    Route::get('all-elements', [CanvasElementController::class, 'getAllElements']);
    Route::delete('canvas-element/{canvasElement}', [CanvasElementController::class, 'destroy']);
    Route::delete('destroy-all-canvas-elements', [CanvasElementController::class, 'destroyAll']);
    Route::post('update-canvas-element', [CanvasElementController::class, 'updateCanvasElements']);
    Route::get('dd-tables', [CanvasElementController::class, 'getDinningTablesDropDown']);

    //Catalogue Routes
    Route::get('canvas-elements-types', [CatalogueController::class, 'getCanvasElementsTypes']);
});







/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user(); 

});*/
