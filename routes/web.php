<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CoupanController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('admin', [AdminController::class, 'index']);
Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::group(['middleware' => 'admin_auth'], function () {
    Route::get('admin/dashboard', [AdminController::class, 'dashboard']);
    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/manage_category', [CategoryController::class, 'manage_category']);
    Route::get('admin/category/manage_category/{id}', [CategoryController::class, 'manage_category']);
    Route::get('admin/updatepassword', [AdminController::class, 'updatepassword']);
    Route::post('admin/category/manage_category_process', [CategoryController::class, 'manage_category_process'])->name('category.manage_category_process');
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);
    Route::get('admin/category/status/{status}/{id}', [CategoryController::class, 'status']);

    Route::get('admin/coupan', [CoupanController::class, 'index']);
    Route::get('admin/coupan/manage_coupan', [CoupanController::class, 'manage_coupan']);
    Route::get('admin/coupan/manage_coupan/{id}', [CoupanController::class, 'manage_coupan']);
    Route::post('admin/coupan/manage_coupan_process', [CoupanController::class, 'manage_coupan_process'])->name('coupan.manage_coupan_process');
    Route::get('admin/coupan/delete/{id}', [CoupanController::class, 'delete']);
    Route::get('admin/coupan/status/{status}/{id}', [CoupanController::class, 'status']);

    Route::get('admin/size', [SizeController::class, 'index']);
    Route::get('admin/size/manage_size', [SizeController::class, 'manage_size']);
    Route::get('admin/size/manage_size/{id}', [SizeController::class, 'manage_size']);
    Route::post('admin/size/manage_size_process', [SizeController::class, 'manage_size_process'])->name('size.manage_size_process');
    Route::get('admin/size/delete/{id}', [SizeController::class, 'delete']);
    Route::get('admin/size/status/{status}/{id}', [SizeController::class, 'status']);

    Route::get('admin/color', [ColorController::class, 'index']);
    Route::get('admin/color/manage_color', [ColorController::class, 'manage_color']);
    Route::get('admin/color/manage_color/{id}', [ColorController::class, 'manage_color']);
    Route::post('admin/color/manage_color_process', [ColorController::class, 'manage_color_process'])->name('color.manage_color_process');
    Route::get('admin/color/delete/{id}', [ColorController::class, 'delete']);
    Route::get('admin/color/status/{status}/{id}', [ColorController::class, 'status']);

    Route::get('admin/product', [ProductController::class, 'index']);
    Route::get('admin/product/manage_product', [ProductController::class, 'manage_product']);
    Route::get('admin/product/manage_product/{id}', [ProductController::class, 'manage_product']);
    Route::post('admin/product/manage_product_process', [ProductController::class, 'manage_product_process'])->name('product.manage_product_process');
    Route::get('admin/product/delete/{id}', [ProductController::class, 'delete']);
    Route::get('admin/product/status/{status}/{id}', [ProductController::class, 'status']);
    Route::get('admin/product/product_attr_delete/{paid}/{pid}', [ProductController::class, 'product_attr_delete']);
    Route::get('admin/product/product_images_delete/{paid}/{pid}', [ProductController::class, 'product_images_delete']);

    Route::get('admin/brand', [BrandController::class, 'index']);
    Route::get('admin/brand/manage_brand', [BrandController::class, 'manage_brand']);
    Route::get('admin/brand/manage_brand/{id}', [BrandController::class, 'manage_brand']);
    Route::post('admin/brand/manage_brand_process', [BrandController::class, 'manage_brand_process'])->name('brand.manage_brand_process');
    Route::get('admin/brand/delete/{id}', [BrandController::class, 'delete']);
    Route::get('admin/brand/status/{status}/{id}', [BrandController::class, 'status']);

    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error', 'Logout sucessfully');
        return redirect('admin');
    });
});
