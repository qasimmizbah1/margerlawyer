<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CmsPageController;
use App\Http\Controllers\Api\CmsSliderController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\TestimonialController;


//Pages By Slug
Route::get('cms-pages/{slug}', [CmsPageController::class, 'showBySlug']);
Route::get('slider', [CmsSliderController::class, 'index']);
Route::get('menus/{menuName}', [MenuController::class, 'getMenuItems']);
Route::get('settings', [SettingController::class, 'index']);
Route::get('posts/', [PostsController::class, 'index']);
Route::get('posts/{slug}', [PostsController::class, 'postbyslug']);
Route::get('testimonial', [TestimonialController::class, 'index']);
