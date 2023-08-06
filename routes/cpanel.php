<?php

declare(strict_types=1);

use App\Http\Controllers\Cpanel;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Project\Index as ProjectIndex;
use App\Http\Livewire\Admin\Menu\Index as MenuIndex;
use App\Http\Livewire\Admin\Language\Index as LanguageIndex;
use App\Http\Livewire\Admin\Redirect\Index as RedirectIndex;
use App\Http\Livewire\Admin\Language\EditTranslation;

Route::redirect('/', 'cpanel/home');
Route::get('/home', Cpanel\DashboardController::class)->name('home');
Route::get('/analytics', Cpanel\AnalyticsController::class)->name('analytics');

Route::get('/language', LanguageIndex::class)->name('language');
Route::get('/translation/{code}', EditTranslation::class)->name('translation');

Route::get('/redirects', RedirectIndex::class)->name('setting.redirects');

Route::get('/menu-settings', MenuIndex::class)->name('menu-settings.index');

Route::get('projects', ProjectIndex::class)->name('projects.index');

Route::prefix('users')->as('users.')->group(function (): void {
    Route::get('/', Cpanel\UserController::class)->name('browse');
});
