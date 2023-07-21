<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Section::insert([
            [
                'id'             => 1,
                'title'          => 'Laravel Maroc',
                'image'          => 'image.jpg',
                'featured_title' => 'Laravel Maroc',
                'subtitle'       => 'LaravelMaroc',
                'label'          => 'LaravelMaroc',
                'link'           => 'https://LaravelMaroc.com/',
                'description'    => 'LaravelMaroc',
                'status'         => '1',
                'bg_color'       => 'bg-red-500',
                'text_color'     => 'bg-red-500',
                'position'       => '1',
                'language_id'    => '1',
                'type'           => 'home',
            ],
            [
                'id'             => 2,
                'title'          => 'About us',
                'image'          => 'image.jpg',
                'featured_title' => 'LaravelMaroc',
                'subtitle'       => 'LaravelMaroc',
                'label'          => 'LaravelMaroc',
                'link'           => 'https://LaravelMaroc.com/',
                'description'    => 'LaravelMaroc',
                'status'         => '1',
                'bg_color'       => 'bg-green-500',
                'text_color'     => 'bg-green-500',
                'position'       => '1',
                'language_id'    => '1',
                'type'           => 'about',
            ],
            [
                'id'             => 3,
                'title'          => 'Contact',
                'image'          => 'image.jpg',
                'featured_title' => 'LaravelMaroc',
                'subtitle'       => 'LaravelMaroc',
                'label'          => 'LaravelMaroc',
                'link'           => 'https://LaravelMaroc.com/',
                'description'    => 'LaravelMaroc',
                'status'         => '1',
                'bg_color'       => 'bg-green-500',
                'text_color'     => 'bg-green-500',
                'position'       => '1',
                'language_id'    => '1',
                'type'           => 'contat',
            ],
        ]);
    }
}
