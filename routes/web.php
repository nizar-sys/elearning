<?php

use App\Http\Controllers\Console\AboutController;
use App\Http\Controllers\Console\ArticleController;
use App\Http\Controllers\Console\BannerController;
use App\Http\Controllers\Console\BenefitController;
use App\Http\Controllers\Console\CategoryController;
use App\Http\Controllers\Console\ElearningController;
use App\Http\Controllers\Console\MaterialController;
use App\Http\Controllers\Console\ReviewController;
use App\Http\Controllers\Console\RoleController;
use App\Http\Controllers\Console\UserController;
use App\Http\Controllers\Console\VideoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\ArticleController as StudentArticleController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\ElearningController as StudentElearningController;
use App\Http\Controllers\Student\VideoController as StudentVideoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about-us', [HomeController::class, 'about'])->name('about-us');
Route::get('/courses', [HomeController::class, 'course'])->name('course');
Route::get('/tutors', [HomeController::class, 'tutor'])->name('tutor');
Route::get('/article-list', [HomeController::class, 'article'])->name('article');
Route::get('/video-list', [HomeController::class, 'video'])->name('video');

Route::get('/detail-course/{courseId}', [HomeController::class, 'detailCourse'])->name('detail-course');
Route::get('/detail-article/{articleId}', [HomeController::class, 'detailArticle'])->name('detail-article');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('console')->middleware(['auth', 'verified', 'role:Administrator,Teacher'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('role:Administrator')->group(function () {
        Route::resource('roles', RoleController::class);
    });

    Route::patch('/users/profile/{id}', [UserController::class, 'updateDetail'])->name('users.profile.update');
    Route::resource('users', UserController::class);

    // global categories
    Route::resource('categories', CategoryController::class);

    // articles
    Route::resource('articles', ArticleController::class);

    // videos
    Route::resource('videos', VideoController::class);

    // elearnings
    Route::resource('benefits', BenefitController::class);
    Route::resource('materials', MaterialController::class);
    Route::resource('elearnings', ElearningController::class);
    Route::resource('reviews', ReviewController::class);

    // banners
    Route::resource('banners', BannerController::class)->only(['index', 'update']);

    // about
    Route::resource('about', AboutController::class)->only(['index', 'update']);
});

Route::prefix('student')->name('student.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

    // elearnings
    Route::get('/elearnings', [StudentElearningController::class, 'index'])->name('elearnings.index');
    Route::get('/elearnings/{slug}', [StudentElearningController::class, 'show'])->name('elearnings.show');
    Route::post('/elearning/{id}/review', [StudentElearningController::class, 'storeReview'])->name('elearnings.review.store');

    // Article Routes
    Route::get('/articles', [StudentArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/{slug}', [StudentArticleController::class, 'show'])->name('articles.show');

    // Videos Routes
    Route::get('/videos', [StudentVideoController::class, 'index'])->name('videos.index');
    Route::get('/videos/{slug}', [StudentVideoController::class, 'show'])->name('videos.show');
});
