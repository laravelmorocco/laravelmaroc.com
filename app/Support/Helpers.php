<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use App\Models\Language;
use App\Models\Category;
use App\Models\BlogCategory;

if ( ! function_exists('getLanguages')) {
    function getLanguages()
    {
        if ( ! Schema::hasTable('languages')) {
            return [];
        }

        return cache()->rememberForever('languages', function () {
            return Session::has('language')
                ? Language::pluck('name', 'code')->toArray()
                : Language::where('is_default', 1)->pluck('name', 'code')->toArray();
        });
    }
}

if ( ! function_exists('getCategories')) {
    function getCategories()
    {
        return cache()->rememberForever('categories', fn () => Category::pluck('name', 'id')->toArray());
    }
}

if ( ! function_exists('getBlogCategories')) {
    function getBlogCategories()
    {
        return cache()->rememberForever('blogCategories', fn () => BlogCategory::pluck('title', 'id')->toArray());
    }
}

if ( ! function_exists('settings')) {
    function settings()
    {
        return cache()->rememberForever('settings', fn () => \App\Models\Settings::firstOrFail());
    }
}

function flagImageUrl($language_code)
{
    return asset("images/flags/{$language_code}.png");
}

function getSlug($request, $key)
{
    $language_default = \App\Models\Language::query()
        ->where('is_default', \App\Models\Language::IS_DEFAULT)
        ->select('code')
        ->first();
    $language_code = $language_default->code;
    $value = $request[$language_code][$key];

    return \Illuminate\Support\Str::slug($value);
}
