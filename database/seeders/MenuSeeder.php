<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            Menu::create([
                'name' => 'Home',
                'label' => 'Home',
                'url' => '/',
                'type' => 'link',
                'placement' => 'header',
                'sort_order' => 1,
                'parent_id' => null,
                'new_window' => false,
            ]);
    
            Menu::create([
                'name' => 'About',
                'label' => 'About',
                'url' => '/about',
                'type' => 'dropdown',
                'placement' => 'header',
                'sort_order' => 2,
                'parent_id' => null,
                'new_window' => false,
            ]);
    
            // Add more menu items as needed
    }
}
