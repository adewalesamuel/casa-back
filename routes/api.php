<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ApiAdminAuthController;
use App\Http\Controllers\Auth\ApiUserAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FeatureProductController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PromoCodeController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('categories',[CategoryController::class, 'index']);
Route::get('categories/{category}', [CategoryController::class, 'show']);

Route::get('regions',[RegionController::class, 'index']);
Route::get('regions/{region}', [RegionController::class, 'show']);

Route::get('cities',[CityController::class, 'index']);
Route::get('cities/{city}', [CityController::class, 'show']);

Route::get('municipalities',[MunicipalityController::class, 'index']);
Route::get('municipalities/{municipality}', [MunicipalityController::class, 'show']);

Route::get('products',[ProductController::class, 'index']);
Route::get('products/{product}', [ProductController::class, 'show']);

Route::get('comments',[CommentController::class, 'index']);
Route::get('comments/{comment}', [CommentController::class, 'show']);

Route::post('register', [ApiUserAuthController::class, 'register']);
Route::post('login', [ApiUserAuthController::class, 'login']);
Route::post('logout', [ApiUserAuthController::class, 'logout']);

Route::middleware('auth.api_token:user')->group(function() {
    Route::get('products', [ProductController::class, 'user_index']);
    Route::post('products',[ProductController::class, 'user_store']);
    Route::put('products/{product}', [ProductController::class, 'user_update']);
    Route::delete('products/{product}', [ProductController::class, 'user_destroy']);

    Route::post('comments',[CommentController::class, 'user_store']);
    Route::put('comments/{comment}', [CommentController::class, 'user_update']);
    Route::delete('comments/{comment}', [CommentController::class, 'user_destroy']);

    Route::get('favorites',[FavoriteController::class, 'index']);
    Route::post('favorites',[FavoriteController::class, 'store']);
    Route::get('favorites/{favorite}', [FavoriteController::class, 'show']);
    Route::put('favorites/{favorite}', [FavoriteController::class, 'update']);
    Route::delete('favorites/{favorite}', [FavoriteController::class, 'destroy']);
});

Route::prefix('admin')->group(function() {
    Route::post('login', [ApiAdminAuthController::class, 'login']);
    Route::post('logout', [ApiAdminAuthController::class, 'logout']);

    Route::middleware('auth.api_token:admin')->group(function() {
        Route::get('permissions',[PermissionController::class, 'index']);
        Route::post('permissions',[PermissionController::class, 'store']);
        Route::get('permissions/{permission}', [PermissionController::class, 'show']);
        Route::put('permissions/{permission}', [PermissionController::class, 'update']);
        Route::delete('permissions/{permission}', [PermissionController::class, 'destroy']);

        Route::get('roles',[RoleController::class, 'index']);
        Route::post('roles',[RoleController::class, 'store']);
        Route::get('roles/{role}', [RoleController::class, 'show']);
        Route::put('roles/{role}', [RoleController::class, 'update']);
        Route::delete('roles/{role}', [RoleController::class, 'destroy']);

        Route::get('admins',[AdminController::class, 'index']);
        Route::post('admins',[AdminController::class, 'store']);
        Route::get('admins/{admin}', [AdminController::class, 'show']);
        Route::put('admins/{admin}', [AdminController::class, 'update']);
        Route::delete('admins/{admin}', [AdminController::class, 'destroy']);

        Route::get('users',[UserController::class, 'index']);
        Route::post('users',[UserController::class, 'store']);
        Route::get('users/{user}', [UserController::class, 'show']);
        Route::put('users/{user}', [UserController::class, 'update']);
        Route::delete('users/{user}', [UserController::class, 'destroy']);

        Route::post('categories',[CategoryController::class, 'store']);
        Route::put('categories/{category}', [CategoryController::class, 'update']);
        Route::delete('categories/{category}', [CategoryController::class, 'destroy']);

        Route::post('regions',[RegionController::class, 'store']);
        Route::put('regions/{region}', [RegionController::class, 'update']);
        Route::delete('regions/{region}', [RegionController::class, 'destroy']);

        Route::post('cities',[CityController::class, 'store']);
        Route::put('cities/{city}', [CityController::class, 'update']);
        Route::delete('cities/{city}', [CityController::class, 'destroy']);

        Route::post('municipalities',[MunicipalityController::class, 'store']);
        Route::put('municipalities/{municipality}', [MunicipalityController::class, 'update']);
        Route::delete('municipalities/{municipality}', [MunicipalityController::class, 'destroy']);

        Route::get('features',[FeatureController::class, 'index']);
        Route::post('features',[FeatureController::class, 'store']);
        Route::get('features/{feature}', [FeatureController::class, 'show']);
        Route::put('features/{feature}', [FeatureController::class, 'update']);
        Route::delete('features/{feature}', [FeatureController::class, 'destroy']);

        Route::post('products',[ProductController::class, 'store']);
        Route::put('products/{product}', [ProductController::class, 'update']);
        Route::delete('products/{product}', [ProductController::class, 'destroy']);

        Route::get('feature-products',[FeatureProductController::class, 'index']);
        Route::post('feature-products',[FeatureProductController::class, 'store']);
        Route::get('feature-products/{feature_product}', [FeatureProductController::class, 'show']);
        Route::put('feature-products/{feature_product}', [FeatureProductController::class, 'update']);
        Route::delete('feature-products/{feature_product}', [FeatureProductController::class, 'destroy']);

        Route::post('comments',[CommentController::class, 'store']);
        Route::put('comments/{comment}', [CommentController::class, 'update']);
        Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

        Route::get('favorites',[FavoriteController::class, 'index']);
        Route::post('favorites',[FavoriteController::class, 'store']);
        Route::get('favorites/{favorite}', [FavoriteController::class, 'show']);
        Route::put('favorites/{favorite}', [FavoriteController::class, 'update']);
        Route::delete('favorites/{favorite}', [FavoriteController::class, 'destroy']);

        Route::get('promo-codes',[PromoCodeController::class, 'index']);
        Route::post('promo-codes',[PromoCodeController::class, 'store']);
        Route::get('promo-codes/{promo_code}', [PromoCodeController::class, 'show']);
        Route::put('promo-codes/{promo_code}', [PromoCodeController::class, 'update']);
        Route::delete('promo-codes/{promo_code}', [PromoCodeController::class, 'destroy']);
    });

});

