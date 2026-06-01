<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CmsPageController;
use App\Http\Controllers\Api\CmsSliderController;
use App\Http\Controllers\Api\LandingPageController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\PostsController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\PortfolioController;
use App\Http\Controllers\Api\GlobalsettingController;
use App\Http\Middleware\VerifyApiKey;
use App\Http\Controllers\Api\ScheduleconsultationsController;
use App\Http\Controllers\Api\EmailsendController;
use App\Http\Controllers\Api\CasestudyController;
use App\Http\Controllers\Api\LogosliderController;
use App\Http\Controllers\Api\TransactionsController;
Use App\Http\Controllers\Api\WebinarController;
use App\Http\Controllers\Api\MilsController;
use App\Http\Controllers\Api\NewsletterController;

Route::post('emailsend', [EmailsendController::class, 'emailsend']);

//Pages By Slug
Route::middleware([VerifyApiKey::class, 'throttle:60,1'])->group(function () {
Route::get('cms-pages/', [CmsPageController::class, 'index']);
Route::get('cms-pages/{slug}', [CmsPageController::class, 'showBySlug']);
Route::get('slider', [CmsSliderController::class, 'index']);
Route::get('menus/', [MenuController::class, 'index']);
Route::get('menus/{menuName}', [MenuController::class, 'getMenuItems']);
Route::get('settings', [SettingController::class, 'index']);
Route::get('posts/', [PostsController::class, 'index']);
Route::get('posts/{slug}', [PostsController::class, 'postbyslug']);
Route::get('testimonial', [TestimonialController::class, 'index']);
Route::get('landing-page/', [LandingPageController::class, 'index']);
Route::get('landing-page/{domain}', [LandingPageController::class, 'showByDomain']);
Route::get('services/', [ServiceController::class, 'index']);
Route::get('services/{slug}', [ServiceController::class, 'servicebyslug']);
Route::get('portfolio/', [PostsController::class, 'index']);
Route::get('portfolio/{slug}', [PostsController::class, 'portfoliobyslug']);
Route::get('globalsetting', [GlobalsettingController::class, 'index']);
Route::get('schedule-consultations', [ScheduleconsultationsController::class, 'index']);
Route::get('case-studies/', [CasestudyController::class, 'index']);
Route::get('case-studies/{slug}', [CasestudyController::class, 'casestudybyslug']);
Route::get('logo-sliders/', [LogosliderController::class, 'index']);
Route::get('logo-sliders/{slug}', [LogosliderController::class, 'logosliderbyslug']);
Route::get('transactions/', [TransactionsController::class, 'index']);
Route::get('transactions/{slug}', [TransactionsController::class, 'transactionbyslug']);    
Route::get('webinars/', [WebinarController::class, 'index']);
Route::get('webinars/{slug}', [WebinarController::class, 'webinarbyslug']);
Route::get('mils-companions/', [MilsController::class, 'index']);
Route::get('mils-companions/{slug}', [MilsController::class, 'milsbyslug']);    
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe']);

});

//Route::get('globalsetting/', [GlobalsettingController::class, 'index']);