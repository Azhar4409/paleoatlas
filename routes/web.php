<?php

use App\Http\Controllers\Front\ProfileController;
use App\Http\Controllers\Front\MyArticleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Back\ConfigController;
use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\CategoryController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Front\ArticleController as FrontArticleController;
use App\Http\Controllers\Front\CategoryController as FrontCategoryController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/about', [HomeController::class, 'about']);
Route::post('/about', [HomeController::class, 'aboutSend'])->name('about.send');

Route::get('/contact', [HomeController::class, 'contact']);
Route::post('/contact', [HomeController::class, 'contactSend'])->name('contact.send');

Route::get('/p/{slug}', [FrontArticleController::class, 'show'])->name('front.article.show');
Route::post('/p/{slug}/comment', [FrontArticleController::class, 'storeComment'])->middleware('auth')->name('front.article.comment.store');
Route::get('/articles', [FrontArticleController::class, 'index']);
Route::post('/articles/search', [FrontArticleController::class, 'index'])->name('search');

Route::get('category/{slug}', [FrontCategoryController::class, 'index']);
Route::get('all-category', [FrontCategoryController::class, 'allCategory']);

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'index'])->name('profil.index');
    Route::post('/profil', [ProfileController::class, 'update'])->name('profil.update');
    Route::get('/profil/show', [ProfileController::class, 'show'])->name('profil.show');

    // Public profile page by user ID
    Route::get('/profil/{user}', [ProfileController::class, 'publicProfile'])->name('profil.public');

    // Artikel user (CRUD, termasuk show)
    Route::resource('my-articles', MyArticleController::class);

    Route::post('/my-articles/upload-image', [MyArticleController::class, 'uploadImage'])->name('my-articles.upload-image');

    Route::post('/my-articles/delete-orphaned-comments', [MyArticleController::class, 'deleteOrphanedComments'])->name('my-articles.delete-orphaned-comments');

    // Remove or comment out the conflicting 'article' resource route for MyArticleController
    // Route::resource('article', MyArticleController::class);
});

Route::middleware(['auth', 'UserAccess:1'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('/article', ArticleController::class);

    Route::resource('categories', CategoryController::class)->only([
        'index', 'store', 'update', 'destroy'
    ]);

    Route::resource('users', UserController::class);
    
    Route::resource('config', ConfigController::class)->only([
        'index', 'update'
    ]);

    Route::resource('knowledge', KnowledgeController::class);

    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth', 'UserAccess:1']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});

/*
Auth::routes();
*/

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');