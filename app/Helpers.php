<?php

declare(strict_types=1);

namespace App;

use App\Models\Category;
use App\Models\Page;
use App\Models\Settings;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class Helpers
{
    /**
     * Fetch Cached settings from database
     *
     * @param mixed $key
     *
     * @return mixed
     */
    public static function settings($key)
    {
        return Cache::rememberForever('settings', function () {
            return Settings::pluck('value', 'key');
        })->get($key);
    }

    public static function getActiveCategories()
    {
        return Category::active()
            ->select('id', 'name')
            ->get();
    }

    public static function getActivePages()
    {
        return Page::active()
            ->select('id', 'title', 'slug')
            ->limit(4)
            ->get();
    }

    public static function categoryName($category_id)
    {
        return Category::find($category_id)->name;
    }

    /**
     * @param mixed $image
     *
     * @return string|null
     */
    public static function uploadImage($image)
    {
        // Path cannot be empty
        if (empty($image)) {
            return null;
        }

        $image = file_get_contents($image);
        $name = Str::random(10).'.jpg';
        $path = public_path().'/images/products/'.$name;
        file_put_contents($path, $image);

        return $name;
    }

    /**
     * @param mixed $gallery
     *
     * @return array<string>|null
     */
    public static function uploadGallery($gallery)
    {
        // Path cannot be empty
        if (empty($gallery)) {
            return null;
        }

        $gallery = explode(',', $gallery);

        return array_map(function ($image) {
            $image = file_get_contents($image);
            $name = Str::random(10).'.jpg';
            $path = public_path().'/images/products/'.$name;
            file_put_contents($path, $image);

            return $name;
        }, $gallery);
    }

    /**
     * @param mixed $input
     *
     * @return string|false|void
     */
    public function handleUpload($input)
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
                Storage::disk('local_files')->put('products/'.$value->getClientOriginalName(), $img, 'public');
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

        Storage::disk('local_files')->put('products/'.$input->getClientOriginalName(), $img, 'public');
    }
}
