<?php

declare(strict_types=1);

use App\Http\Controllers\ErrorController;
use App\Http\Controllers\FrontController;
use App\Http\Livewire\Front\Index as FrontIndex;
use App\Http\Livewire\Front\Blogs as BlogIndex;
use App\Http\Livewire\Front\ShowBlog as BlogShow;
use App\Http\Controllers\UploadController;
use Illuminate\Http\Request;
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

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::post('/uploads', [UploadController::class, 'upload'])->name('upload');

Route::get('/optimize', [FrontController::class, 'optimize']);

Route::get('/', FrontIndex::class)->name('front.index');

Route::get('/categories', [FrontController::class, 'categories'])->name('front.categories');
Route::get('/categorie/{slug}', [FrontController::class, 'categoryPage'])->name('front.categoryPage');

Route::get('/projects', [FrontController::class, 'project'])->name('front.projects');

Route::get('/project/{slug}', [FrontController::class, 'portfolioDetails'])->name('front.portfolioDetails');

Route::get('/contact', [FrontController::class, 'contact'])->name('front.contact');

Route::get('/blog', BlogIndex::class)->name('front.blogs');
Route::get('/blog/{slug}', BlogShow::class)->name('front.blogPage');

Route::get('/page/{slug}', [FrontController::class, 'dynamicPage'])->name('front.dynamicPage');

Route::get('/generate-sitemap', [FrontController::class, 'generateSitemaps'])->name('generate-sitemaps');

Route::get('/lang/{lang}', [FrontController::class, 'changelanguage'])->name('changeLanguage');

Route::fallback(function (Request $request) {
    return app()->make(ErrorController::class)->notFound($request);
});
