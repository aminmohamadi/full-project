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

//$data = <<<EOF
//RewriteEngine on
//RewriteRule …
//EOF;
//file_put_contents(public_path('.htaccess'), $data);
Route::namespace('Auth')->group(function () {
    Route::post('login/otp', [\App\Http\Controllers\Auth\LoginWithOtp::class, 'login'])->name('two_factor_auth_post');
    Route::get('login/otp', [\App\Http\Controllers\Auth\LoginWithOtp::class, 'challenge'])->name('two_factor_auth_get');
    Route::post('login/otp/regenerate', [\App\Http\Controllers\Auth\LoginWithOtp::class, 'regenerate'])->name('regenerate_otp');
    Route::post('login', [\App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
    Route::get('login', [\App\Http\Controllers\Auth\LoginController::class, 'loginForm'])->name('login.get');
    Route::get('recover', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'index'])->middleware('guest')->name('recover.get');
    Route::get('recover/code', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'code'])->middleware('guest')->name('recover.code');
    Route::post('recover', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'password'])->middleware('guest')->name('recover.post');
    Route::post('validate-reset-password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->middleware('guest')->name('password.validate');
    Route::post('logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->middleware('auth')->name('logout');
});
Route::prefix('/')->middleware('auth')->group(function () {
    Route::get('/asc', function () {
        dd(auth()->user());
        return view('dashboard.index');
    })->name('dashboard');
    Route::get('/', function () {
        return view('dashboard.index');
    })->name('home');
    Route::prefix('role')->group(function () {
        Route::get('/', [\App\Http\Controllers\RoleController::class, 'indexAction'])->name('role.index')->can('role.index');
        Route::get('/create', [\App\Http\Controllers\RoleController::class, 'createAction'])->name('role.create')->can('role.create');
        Route::post('/create', [\App\Http\Controllers\RoleController::class, 'storeAction'])->name('role.store')->can('role.store');
        Route::get('/edit/{role}', [\App\Http\Controllers\RoleController::class, 'showAction'])->name('role.show')->can('role.show');
        Route::patch('/update/{role}', [\App\Http\Controllers\RoleController::class, 'updateAction'])->name('role.update')->can('role.update');
        Route::delete('/delete/{role}', [\App\Http\Controllers\RoleController::class, 'destroyAction'])->name('role.destroy')->can('role.destroy');
    });
    Route::prefix('menu')->group(function () {
        Route::get('/{role}', [\App\Http\Controllers\MenuController::class, 'showAction'])->name('role.menu.show')->can('menu.show');
        Route::get('/create/{role}', [\App\Http\Controllers\MenuController::class, 'createAction'])->name('role.menu.create')->can('menu.create');
        Route::post('/create/{role}', [\App\Http\Controllers\MenuController::class, 'storeAction'])->name('role.menu.store')->can('menu.store');
        Route::post('/role', [\App\Http\Controllers\MenuController::class, 'role'])->name('role.menu')->can('menu.role');
        Route::get('/edit/menu/{menu}', [\App\Http\Controllers\MenuController::class, 'editAction'])->name('role.menu.edit')->can('menu.edit');
        Route::patch('/update/menu/{menu}', [\App\Http\Controllers\MenuController::class, 'updateAction'])->name('role.menu.update')->can('menu.update');
        Route::delete('/delete/menu/{menu}', [\App\Http\Controllers\MenuController::class, 'destroyAction'])->name('role.menu.destroy')->can('menu.destroy');
    });
    Route::prefix('functionalities')->group(function () {
        Route::get('/', [\App\Http\Controllers\FunctionalityController::class, 'indexAction'])->name('functionality.index')->can('functionality.index');
        Route::post('/', [\App\Http\Controllers\FunctionalityController::class, 'storeAction'])->name('functionality.store')->can('functionality.store');

    });
    Route::prefix('functionality')->group(function () {
        Route::get('role/{role}', [\App\Http\Controllers\FunctionalityRoleController::class, 'showAction'])->name('role.functionality.get')->can('functionalityrole.show');
        Route::post('role/{role}', [\App\Http\Controllers\FunctionalityRoleController::class, 'storeAction'])->name('role.functionality.store')->can('functionalityrole.store');
    });
    Route::prefix('post')->group(function () {
        Route::get('/', [\App\Http\Controllers\PostController::class, 'indexAction'])->name('post.index')->can('post.index');
        Route::get('/create', [\App\Http\Controllers\PostController::class, 'createAction'])->name('post.create')->can('post.create');
        Route::post('/create', [\App\Http\Controllers\PostController::class, 'storeAction'])->name('post.store')->can('post.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\PostController::class, 'showAction'])->name('post.show')->can('post.show');
        Route::patch('/update/{id}', [\App\Http\Controllers\PostController::class, 'updateAction'])->name('post.update')->can('post.update');
        Route::delete('/delete/{id}', [\App\Http\Controllers\PostController::class, 'destroyAction'])->name('post.delete')->can('post.destroy');
        Route::post('/image/upload', [\App\Http\Controllers\Auth\ProfileController::class, 'uploadAvatar'])->name('upload.post.image');
        Route::delete('/image/delete', [\App\Http\Controllers\Auth\ProfileController::class, 'removeAvatar'])->name('delete.post.image');

    });
    Route::prefix('category')->group(function () {
        Route::get('/', [\App\Http\Controllers\CategoryController::class, 'indexAction'])->name('category.index')->can('category.index');
        Route::get('/create', [\App\Http\Controllers\CategoryController::class, 'createAction'])->name('category.create')->can('category.create');
        Route::post('/create', [\App\Http\Controllers\CategoryController::class, 'storeAction'])->name('category.store')->can('category.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\CategoryController::class, 'showAction'])->name('category.show')->can('category.show');
        Route::patch('/update/{id}', [\App\Http\Controllers\CategoryController::class, 'updateAction'])->name('category.update')->can('category.update');
        Route::delete('/delete/{id}', [\App\Http\Controllers\CategoryController::class, 'destroyAction'])->name('category.delete')->can('category.destroy');
    });
    Route::prefix('slider')->group(function () {
        Route::get('/', [\App\Http\Controllers\SliderController::class, 'indexAction'])->name('slider.index')->can('slider.index');
        Route::get('/create', [\App\Http\Controllers\SliderController::class, 'createAction'])->name('slider.create')->can('slider.create');
        Route::post('/create', [\App\Http\Controllers\SliderController::class, 'storeAction'])->name('slider.store')->can('slider.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\SliderController::class, 'showAction'])->name('slider.show')->can('slider.show');
        Route::patch('/update/{id}', [\App\Http\Controllers\SliderController::class, 'updateAction'])->name('slider.update')->can('slider.update');
        Route::delete('/delete/{id}', [\App\Http\Controllers\SliderController::class, 'destroyAction'])->name('slider.delete')->can('slider.destroy');
    });

    Route::prefix('option')->group(function () {
        Route::get('/', [\App\Http\Controllers\OptionController::class, 'indexAction'])->name('option.index')->can('option.index');
        Route::post('/', [\App\Http\Controllers\OptionController::class, 'storeAction'])->name('option.store')->can('option.store');
    });

    Route::prefix('service')->group(function () {
        Route::get('/', [\App\Http\Controllers\ServiceController::class, 'indexAction'])->name('service.index')->can('service.index');
        Route::get('/create', [\App\Http\Controllers\ServiceController::class, 'createAction'])->name('service.create')->can('service.create');
        Route::post('/create', [\App\Http\Controllers\ServiceController::class, 'storeAction'])->name('service.store')->can('service.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\ServiceController::class, 'showAction'])->name('service.show')->can('service.show');
        Route::patch('/update/{id}', [\App\Http\Controllers\ServiceController::class, 'updateAction'])->name('service.update')->can('service.update');
        Route::delete('/delete/{id}', [\App\Http\Controllers\ServiceController::class, 'destroyAction'])->name('service.delete')->can('service.destroy');
    });

    Route::prefix('project')->group(function () {
        Route::get('/', [\App\Http\Controllers\ProjectController::class, 'indexAction'])->name('project.index')->can('project.index');
        Route::get('/create', [\App\Http\Controllers\ProjectController::class, 'createAction'])->name('project.create')->can('project.create');
        Route::post('/create', [\App\Http\Controllers\ProjectController::class, 'storeAction'])->name('project.store')->can('project.store');
        Route::get('/edit/{id}', [\App\Http\Controllers\ProjectController::class, 'showAction'])->name('project.show')->can('project.show');
        Route::patch('/update/{id}', [\App\Http\Controllers\ProjectController::class, 'updateAction'])->name('project.update')->can('project.update');
        Route::delete('/delete/{id}', [\App\Http\Controllers\ProjectController::class, 'destroyAction'])->name('project.delete')->can('project.destroy');

        Route::post('/{project}/image/upload', [\App\Http\Controllers\ProjectController::class, 'image_uploadAction'])->name('upload.project.image')->can('project.image_upload');
        Route::delete('/delete/image/{image}', [\App\Http\Controllers\ProjectController::class, 'image_deleteAction'])->name('delete.project.image')->can('project.image_delete');
    });
    Route::prefix('security')->group(function (){
        Route::get('blacklist',[\App\Http\Controllers\SecurityController::class,'blacklistAction'])->name('security.blacklist.index')->can('security.blacklist');
        Route::post('block',[\App\Http\Controllers\SecurityController::class,'blockAction'])->name('security.block')->can('security.block');

        Route::get('whitelist',[\App\Http\Controllers\SecurityController::class,'whitelistAction'])->name('security.whitelist.index')->can('security.whitelist');
        Route::post('whitelist',[\App\Http\Controllers\SecurityController::class,'whiteAction'])->name('security.white')->can('security.white');
    });
});
