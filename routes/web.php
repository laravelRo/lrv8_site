<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ArticlesController;

use App\Http\Controllers\Front\PagesController;
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

Route::get('/dashboard', function () {
    return view('admin.control-panel');
})->middleware(['auth'])->name('dashboard');

// ==== routele de administrare ====>
Route::prefix('admin')->middleware(['admin'])->group(function () {

    Route::get('/users', [UsersController::class, 'showUsers'])->name('users');
    Route::get('/user-new', [UsersController::class, 'newUser'])->name('users.new');
    Route::post('/user-new', [UsersController::class, 'createUser'])->name('users.create');

    // ====> Editare Users =====
    Route::get('/user-edit/{id}', [UsersController::class, 'showEditForm'])->name('users.editForm');
    Route::put('/user-edit/{id}', [UsersController::class, 'updateUser'])->name('users.update');
    Route::delete('/user-delete/{id}', [UsersController::class, 'deleteUser'])->name('users.delete');
});

// ===> routele pentru categorii
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {

    // afisam categoriile
    Route::get('categories', [CategoryController::class, 'showCategories'])->name('admin.categories');
    Route::get('categories/new', [CategoryController::class, 'newCategory'])->name('admin.categories.new');
    Route::post('categories/new', [CategoryController::class, 'addCategory'])->name('admin.categories.add');

    Route::get('categories/edit/{id}', [CategoryController::class, 'editCategory'])->name('admin.categories.edit');
    Route::put('categories/edit/{id}', [CategoryController::class, 'updateCategory'])->name('admin.categories.update');
    Route::delete('categories/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.categories.delete');



    // <==== routele pentru pagini ====
    Route::get('pages', [ArticlesController::class, 'showPages'])->name('admin.pages');
    Route::get('pages/new', [ArticlesController::class, 'newPage'])->name('admin.pages.new');
    Route::post('pages/new', [ArticlesController::class, 'addPage'])->name('admin.pages.add');

    Route::get('pages/edit/{id}', [ArticlesController::class, 'editPage'])->name('admin.pages.edit');
    Route::put('pages/edit/{id}', [ArticlesController::class, 'updatePage'])->name('admin.pages.update');
    Route::delete('pages/delete/{id}', [ArticlesController::class, 'deletePage'])->name('admin.pages.delete');

    Route::get('pages/categories/{id}', [ArticlesController::class, 'showCategories'])->name('admin.pages.showCategories');
    Route::put('pages/categories/{id}', [ArticlesController::class, 'setCategories'])->name('admin.pages.setCategories');
});

// <==== routele de administrare ====

// ==== routele pentru utilizatori ====>

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('profile', [ProfileController::class, 'showProfile'])->name('user.profile');
    Route::put('profile', [ProfileController::class, 'updateProfile'])->name('user.profile-update');

    //=== ruta pentru resetarea parolei
    Route::put('reset-password', [ProfileController::class, 'resetPassword'])->name('user.reset-password');
});

// <==== routele pentru utilizatori ====


// ====>rutele publice ===
Route::get('/', [PagesController::class, 'homePage'])->name('home');
Route::get('/category/{category:slug}', [PagesController::class, 'categoryPage'])->name('category');
Route::get('/articles', [PagesController::class, 'showArticles'])->name('articles');
Route::get('/article/{page:slug}', [PagesController::class, 'showSingleArticle'])->name('article');


require __DIR__ . '/auth.php';
