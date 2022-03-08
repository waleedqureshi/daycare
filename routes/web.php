<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();


Route::group(['middleware' => 'auth', 'prevent-back-history'], function () {
    //trigger daily notifications
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index']);

    //Role Routes
    Route::get('/role/view', [App\Http\Controllers\RoleController::class, 'view'])->middleware('can:View Role');
    Route::get('/role/add', [App\Http\Controllers\RoleController::class, 'create'])->middleware('can:Add Role');
    Route::post('/role/store', [App\Http\Controllers\RoleController::class, 'store'])->middleware('can:Add Role');
    Route::get('/role/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->middleware('can:Edit Role');
    Route::post('/role/update/{id}', [App\Http\Controllers\RoleController::class, 'update']);
    Route::get('/role/destroy/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->middleware('can:Delete Role');
    Route::post('/role/role_check', [App\Http\Controllers\RoleController::class, 'role_check']);
    
    //User Routes
    Route::get('/user/view', [App\Http\Controllers\UserController::class, 'view'])->middleware('can:View User');
    Route::get('/user/add', [App\Http\Controllers\UserController::class, 'create'])->middleware('can:Add User');
    Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->middleware('can:Add User');
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->middleware('can:Edit User');
    Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->middleware('can:Edit User');
    Route::get('/user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('can:Delete User');

    //Register Routes
    Route::get('/register/view', [App\Http\Controllers\RegisterController::class, 'view'])->middleware('can:View Register');
    Route::get('/register/add', [App\Http\Controllers\RegisterController::class, 'create'])->middleware('can:Add Register');
    Route::post('/register/store', [App\Http\Controllers\RegisterController::class, 'store'])->middleware('can:Add Register');
    Route::get('/register/edit/{id}', [App\Http\Controllers\RegisterController::class, 'edit'])->middleware('can:Edit Register');
    Route::post('/register/update/{id}', [App\Http\Controllers\RegisterController::class, 'update'])->middleware('can:Edit Register');
    Route::get('/register/destroy/{id}', [App\Http\Controllers\RegisterController::class, 'destroy'])->middleware('can:Delete Register');
    Route::get('/register/attendance/{id}', [App\Http\Controllers\RegisterController::class, 'attendance'])->middleware('can:View Attendance            ');
    

    //Teacher Routes
    Route::get('/teacher/view', [App\Http\Controllers\TeacherController::class, 'view'])->middleware('can:View Teacher');
    Route::get('/teacher/add', [App\Http\Controllers\TeacherController::class, 'create'])->middleware('can:Add Teacher');
    Route::post('/teacher/store', [App\Http\Controllers\TeacherController::class, 'store'])->middleware('can:Add Teacher');
    Route::get('/teacher/edit/{id}', [App\Http\Controllers\TeacherController::class, 'edit'])->middleware('can:Edit Teacher');
    Route::post('/teacher/update/{id}', [App\Http\Controllers\TeacherController::class, 'update'])->middleware('can:Edit Teacher');
    Route::get('/teacher/destroy/{id}', [App\Http\Controllers\TeacherController::class, 'destroy'])->middleware('can:Delete Teacher');

    //Room Routes
    Route::get('/room/view', [App\Http\Controllers\RoomController::class, 'view'])->middleware('can:View Room');
    Route::get('/room/add', [App\Http\Controllers\RoomController::class, 'create'])->middleware('can:Add Room');
    Route::post('/room/store', [App\Http\Controllers\RoomController::class, 'store'])->middleware('can:Add Room');
    Route::get('/room/edit/{id}', [App\Http\Controllers\RoomController::class, 'edit'])->middleware('can:Edit Room');
    Route::post('/room/update/{id}', [App\Http\Controllers\RoomController::class, 'update'])->middleware('can:Edit Room');
    Route::get('/room/destroy/{id}', [App\Http\Controllers\RoomController::class, 'destroy'])->middleware('can:Delete Room');
    Route::post('/room/assign_teacher/{id}', [App\Http\Controllers\RoomController::class, 'assign_teacher'])->middleware('can:Assign Teacher');

    //Session Routes
    Route::get('/session/view', [App\Http\Controllers\SessionController::class, 'view'])->middleware('can:View Session');
    Route::get('/session/add', [App\Http\Controllers\SessionController::class, 'create'])->middleware('can:Add Session');
    Route::post('/session/store', [App\Http\Controllers\SessionController::class, 'store'])->middleware('can:Add Session');
    Route::get('/session/edit/{id}', [App\Http\Controllers\SessionController::class, 'edit'])->middleware('can:Edit Session');
    Route::post('/session/update/{id}', [App\Http\Controllers\SessionController::class, 'update'])->middleware('can:Edit Session');
    Route::get('/session/destroy/{id}', [App\Http\Controllers\SessionController::class, 'destroy'])->middleware('can:Delete Session');
    Route::post('/session/slot/{id}', [App\Http\Controllers\RoomController::class, 'slot'])->middleware('can:Add/Edit Slots');
    Route::get('/session/allocate/{id}', [App\Http\Controllers\SessionController::class, 'allocate'])->middleware('can:Allocate Session');
    Route::post('/session/allocate/store/', [App\Http\Controllers\SessionController::class, 'allocate_store'])->middleware('can:Allocate Session');
    Route::post('/session/allocate/update_slots', [App\Http\Controllers\SessionController::class, 'update_slots'])->middleware('can:Allocate Session');
    
    
    //Slot Routes
    Route::get('/slot/view/{id}', [App\Http\Controllers\SlotController::class, 'view']);
    Route::post('/slot/store', [App\Http\Controllers\SlotController::class, 'store']);
    Route::get('/slot/edit/{id}', [App\Http\Controllers\SlotController::class, 'edit']);
    Route::post('/slot/update/{id}', [App\Http\Controllers\SlotController::class, 'update']);
    Route::get('/slot/destroy/{id}', [App\Http\Controllers\SlotController::class, 'destroy']);

    //Dashboard Route
    Route::get('/occupancy', [App\Http\Controllers\DashboardController::class, 'occupancy'])->middleware('can:View Occupancy');
    Route::get('/attendance', [App\Http\Controllers\DashboardController::class, 'attendance'])->middleware('can:Mark Attendance');
    Route::post('/attendance/get_slots', [App\Http\Controllers\DashboardController::class, 'get_slots']);
    Route::post('/attendance/get_childs', [App\Http\Controllers\DashboardController::class, 'get_childs']);
    Route::post('/attendance/save', [App\Http\Controllers\DashboardController::class, 'save'])->middleware('can:Mark Attendance');
});