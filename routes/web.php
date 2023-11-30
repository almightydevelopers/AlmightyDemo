<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('dashboard',[AdminController::class,'index']);
Route::get('userlist',[AdminController::class,'showlist']);
Route::get('AproveUser',[AdminController::class,'AproveUser']);
Route::get('DenyUser',[AdminController::class,'DenyUser']);

//************************************************************** */
Route::get('loginForm',[AdminController::class,'loginForm']);
Route::post('submitLogin',[AdminController::class,'submitLogin']);
Route::get('logout',[AdminController::class,'logout']);
Route::get('registerpage',[AdminController::class,'adduser']);
Route::post('adduser',[AdminController::class,'registerSubmit']);
Route::get('deleteUser/{id}',[AdminController::class,'deleteUser']);
Route::post('editUser',[AdminController::class,'editUserForm']);
Route::post('updateUser',[AdminController::class,'updateUser']);

