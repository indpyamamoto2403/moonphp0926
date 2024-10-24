<?php
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerViewController;
use App\Http\Controllers\UserNewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\PushFavoriteToSearchNewsController;
use App\Http\Controllers\KeywordSearchController;
use App\Http\Controllers\ShowNewsController;
use App\Http\Controllers\FavoritedNewsListController;
use App\Http\Controllers\ChangeUserIndustryController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/customer', [CustomerController::class, 'index'])->middleware(['auth', 'verified'])->name('customer');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    #api
    Route::post('/api/upload-image', [ImageUploadController::class, 'upload']);
    Route::post('/api/extract-text', [ImageUploadController::class, 'extract']);
    Route::post('/api/push-favorite-to-search-news', [PushFavoriteToSearchNewsController::class, 'index'])->name('push-favorite-to-search-news');
    Route::post('/api/push-unfavorite-to-search-news', [PushFavoriteToSearchNewsController::class, 'reverse'])->name('push-unfavorite-to-search-news');
    Route::post('/api/push-neutral-to-search-news', [PushFavoriteToSearchNewsController::class, 'neutral'])->name('push-neutral-to-search-news');

    Route::post('/customer/completed', [CustomerController::class, 'completed'])->name('completed');
    //getでアクセスした場合、customerにリダイレクト
    Route::get('/customer/completed', function () {
        return redirect('/customer');
    });

    Route::get('/customer/view', [CustomerViewController::class, 'index'])->name('customer-view');
    Route::get('/customer/news', [UserNewsController::class, 'index'])->name('customer-news');
    Route::get('/customer/edit', [ChangeUserIndustryController::class, 'index'])->name('change-user-industry');
    Route::post('/customer/edit/{cluster_id}', [ChangeUserIndustryController::class, 'edit'])->name('change-user-industry-edit');
    Route::get('/keyword-search', [KeywordSearchController::class, 'index'])->name('keyword-search');
    Route::post('/show-news', [ShowNewsController::class, 'index'])->name('show-news');
    Route::post('/show-news-by-url', [ShowNewsController::class, 'url'])->name('show-news-by-url');
    Route::get('/favorited-news-list', [FavoritedNewsListController::class, 'index'])->name('favorited-news-list');
});
require __DIR__.'/auth.php';
