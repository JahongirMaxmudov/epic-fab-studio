<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SectionController as AdminSectionController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Web Routes (Epic Games / Fab.com / Unreal Engine Style)
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Level 2 Tile View: Section catalog
Route::get('/section/{slug}', [CatalogController::class, 'section'])->name('catalog.section');

// Level 3 Fab.com Product Presentation View
Route::get('/section/{section_slug}/{product_slug}', [CatalogController::class, 'product'])->name('catalog.product');

// News & DevLog
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// Comments Submission
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');

/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function (): void {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');

    // Sections (Level 1 Categories)
    Route::resource('sections', AdminSectionController::class);

    // Products with Visual Block Builder
    Route::resource('products', AdminProductController::class);

    // News & DevLog
    Route::resource('news', AdminNewsController::class);

    // Comments Moderation
    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::post('/comments/{id}/approve', [AdminCommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{id}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');

    // Site Settings
    Route::get('/settings', [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
});
