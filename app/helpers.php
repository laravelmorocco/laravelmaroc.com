<?php

declare(strict_types=1);

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Output\RenderedContentInterface;
use App\Models\Category;
use App\Models\Page;
use App\Models\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

if (! function_exists('settings')) {
    /**
     * Fetch Cached settings from database
     *
     * @param mixed $key
     *
     * @return mixed
     */
    function settings($key)
    {
        return Cache::rememberForever('settings', function () {
            return Settings::pluck('value', 'key');
        })->get($key);
    }
}

if (! function_exists('getActiveCategories')) {
    function getActiveCategories()
    {
        return Category::active()
            ->select('id', 'name')
            ->get();
    }
}

if (! function_exists('getActivePages')) {
    function getActivePages()
    {
        return Page::active()
            ->select('id', 'title', 'slug')
            ->limit(4)
            ->get();
    }
}

if (! function_exists('categoryName')) {
    function categoryName($category_id)
    {
        return Category::find($category_id)->name;
    }
}

if (! function_exists('uploadImage')) {
    /**
     * @param mixed $image
     *
     * @return string|null
     */
    function uploadImage($image)
    {
        // Path cannot be empty
        if (empty($image)) {
            return null;
        }

        $image = file_get_contents($image);
        $name = Str::random(10) . '.jpg';
        $path = public_path() . '/images/products/' . $name;
        file_put_contents($path, $image);

        return $name;
    }
}

if (! function_exists('uploadGallery')) {
    /**
     * @param mixed $gallery
     *
     * @return array<string>|null
     */
    function uploadGallery($gallery)
    {
        // Path cannot be empty
        if (empty($gallery)) {
            return null;
        }

        $gallery = explode(',', $gallery);

        return array_map(function ($image) {
            $image = file_get_contents($image);
            $name = Str::random(10) . '.jpg';
            $path = public_path() . '/images/products/' . $name;
            file_put_contents($path, $image);

            return $name;
        }, $gallery);
    }
}

if (! function_exists('handleUpload')) {
    /**
     * @param mixed $input
     *
     * @return string|false|void
     */
    function handleUpload($input)
    {
        if (is_array($input)) {
            // handle gallery
            $galleryArray = [];

            foreach ($input as $key => $value) {
                $img = Image::make($value->getRealPath())->encode('webp', 85)->resize(1000, 1000, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $img->stream();
                Storage::disk('local_files')->put('products/' . $value->getClientOriginalName(), $img, 'public');
                $galleryArray[] = $value->getClientOriginalName();
            }

            return json_encode($galleryArray);
        }
        // handle single image

        $img = Image::make($input->getRealPath())->encode('webp', 85)->resize(1000, 1000, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $img->stream();

        Storage::disk('local_files')->put('products/' . $input->getClientOriginalName(), $img, 'public');
    }
}


if ( ! function_exists('active')) {
    /**
     * @param array<string> $routes
     * @param string $activeClass
     * @param string $defaultClass
     * @param bool $condition
     * @return string
     */
    function active(array $routes, string $activeClass = 'active', string $defaultClass = '', bool $condition = true): string
    {
        return call_user_func_array([app('router'), 'is'], $routes) && $condition ? $activeClass : $defaultClass;
    }
}

if ( ! function_exists('is_active')) {
    /**
     * Determines if the given routes are active.
     */
    function is_active(string ...$routes): bool
    {
        return (bool) call_user_func_array([app('router'), 'is'], (array) $routes);
    }
}

if ( ! function_exists('md_to_html')) {
    function md_to_html(string $markdown): RenderedContentInterface
    {
        return Markdown::convert($markdown);
    }
}

if ( ! function_exists('replace_links')) {
    function replace_links(string $markdown): string
    {
        return (new LinkFinder([
            'attrs' => ['target' => '_blank', 'rel' => 'nofollow'],
        ]))->processHtml($markdown);
    }
}

if ( ! function_exists('get_current_theme')) {
    function get_current_theme(): string
    {
        return Auth::user() ?
            Auth::user()->setting('theme', 'theme-light') :
            'theme-light';
    }
}

if ( ! function_exists('canonical')) {
    /**
     * @param string $route
     * @param array<string> $params
     * @return string
     */
    function canonical(string $route, array $params = []): string
    {
        $page = app('request')->get('page');
        $params = array_merge($params, ['page' => 1 !== $page ? $page : null]);

        ksort($params);

        return route($route, $params);
    }
}

if ( ! function_exists('getFilter')) {
    /**
     * @param string $key
     * @param array<string> $filters
     * @param string $default
     * @return string
     */
    function getFilter(string $key, array $filters = [], string $default = 'recent'): string
    {
        $filter = (string) request($key);

        return in_array($filter, $filters) ? $filter : $default;
    }
}

if ( ! function_exists('route_to_reply_able')) {
    /**
     * Returns the route for the replyAble.
     *
     * @param  \App\Models\Thread|\App\Models\Discussion  $replyAble
     * @return string
     */
    function route_to_reply_able(mixed $replyAble): string
    {
        return $replyAble instanceof \App\Models\Thread ?
            route('forum.show', $replyAble->slug()) :
            route('discussions.show', $replyAble->slug());
    }
}
