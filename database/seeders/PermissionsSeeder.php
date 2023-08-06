<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id'   => 1,
                'name' => 'section_access',
            ],
            [
                'id'   => 2,
                'name' => 'section_create',
            ],
            [
                'id'   => 3,
                'name' => 'section_update',
            ],
            [
                'id'   => 4,
                'name' => 'section_delete',
            ],
            [
                'id'   => 5,
                'name' => 'section_show',
            ],
            [
                'id'   => 6,
                'name' => 'role_access',
            ],
            [
                'id'   => 7,
                'name' => 'role_create',
            ],
            [
                'id'   => 8,
                'name' => 'role_update',
            ],
            [
                'id'   => 9,
                'name' => 'role_delete',
            ],
            [
                'id'   => 10,
                'name' => 'role_show',
            ],
            [
                'id'   => 11,
                'name' => 'permission_access',
            ],
            [
                'id'   => 12,
                'name' => 'permission_create',
            ],
            [
                'id'   => 13,
                'name' => 'permission_update',
            ],
            [
                'id'   => 14,
                'name' => 'permission_delete',
            ],
            [
                'id'   => 15,
                'name' => 'permission_show',
            ],
            [
                'id'   => 16,
                'name' => 'user_access',
            ],
            [
                'id'   => 17,
                'name' => 'user_create',
            ],
            [
                'id'   => 18,
                'name' => 'user_update',
            ],
            [
                'id'   => 19,
                'name' => 'user_delete',
            ],
            [
                'id'   => 20,
                'name' => 'user_show',
            ],
            [
                'id'   => 21,
                'name' => 'product_access',
            ],
            [
                'id'   => 22,
                'name' => 'product_create',
            ],
            [
                'id'   => 23,
                'name' => 'product_update',
            ],
            [
                'id'   => 24,
                'name' => 'product_delete',
            ],
            [
                'id'   => 25,
                'name' => 'product_show',
            ],
            [
                'id'   => 26,
                'name' => 'blog_access',
            ],
            [
                'id'   => 27,
                'name' => 'blog_create',
            ],
            [
                'id'   => 28,
                'name' => 'blog_update',
            ],
            [
                'id'   => 29,
                'name' => 'blog_delete',
            ],
            [
                'id'   => 30,
                'name' => 'blog_show',
            ],
            [
                'id'   => 31,
                'name' => 'order_access',
            ],
            [
                'id'   => 32,
                'name' => 'order_create',
            ],
            [
                'id'   => 33,
                'name' => 'order_update',
            ],
            [
                'id'   => 34,
                'name' => 'order_delete',
            ],
            [
                'id'   => 35,
                'name' => 'order_show',
            ],
            [
                'id'   => 36,
                'name' => 'subcategory_access',
            ],
            [
                'id'   => 37,
                'name' => 'subcategory_create',
            ],
            [
                'id'   => 38,
                'name' => 'subcategory_update',
            ],
            [
                'id'   => 39,
                'name' => 'subcategory_delete',
            ],
            [
                'id'   => 40,
                'name' => 'subcategory_show',
            ],
            [
                'id'   => 41,
                'name' => 'setting_access',
            ],
            [
                'id'   => 42,
                'name' => 'dashboard_access',
            ],
            [
                'id'   => 43,
                'name' => 'page_access',
            ],
            [
                'id'   => 44,
                'name' => 'page_settings',
            ],
            [
                'id'   => 45,
                'name' => 'category_access',
            ],
            [
                'id'   => 46,
                'name' => 'category_create',
            ],
            [
                'id'   => 47,
                'name' => 'category_update',
            ],
            [
                'id'   => 48,
                'name' => 'category_delete',
            ],
            [
                'id'   => 49,
                'name' => 'category_show',
            ],
            [
                'id'   => 50,
                'name' => 'brand_access',
            ],
            [
                'id'   => 51,
                'name' => 'brand_create',
            ],
            [
                'id'   => 52,
                'name' => 'brand_update',
            ],
            [
                'id'   => 53,
                'name' => 'brand_delete',
            ],
            [
                'id'   => 54,
                'name' => 'brand_show',
            ],
            [
                'id'   => 55,
                'name' => 'slider_access',
            ],
            [
                'id'   => 56,
                'name' => 'slider_create',
            ],
            [
                'id'   => 57,
                'name' => 'slider_update',
            ],
            [
                'id'   => 58,
                'name' => 'slider_delete',
            ],
            [
                'id'   => 59,
                'name' => 'slider_show',
            ],
            [
                'id'   => 60,
                'name' => 'featuredbanner_access',
            ],
            [
                'id'   => 61,
                'name' => 'featuredbanner_create',
            ],
            [
                'id'   => 62,
                'name' => 'featuredbanner_update',
            ],
            [
                'id'   => 63,
                'name' => 'featuredbanner_delete',
            ],
            [
                'id'   => 64,
                'name' => 'featuredbanner_show',
            ],
            [
                'id'   => 65,
                'name' => 'subcategory_access',
            ],
            [
                'id'   => 66,
                'name' => 'subcategory_create',
            ],
            [
                'id'   => 67,
                'name' => 'subcategory_update',
            ],
            [
                'id'   => 68,
                'name' => 'subcategory_delete',
            ],
            [
                'id'   => 69,
                'name' => 'subcategory_show',
            ],
            [
                'id'   => 70,
                'name' => 'blogcategory_access',
            ],
            [
                'id'   => 71,
                'name' => 'blogcategory_create',
            ],
            [
                'id'   => 72,
                'name' => 'blogcategory_update',
            ],
            [
                'id'   => 73,
                'name' => 'blogcategory_delete',
            ],
            [
                'id'   => 74,
                'name' => 'blogcategory_show',
            ],
            [
                'id'   => 80,
                'name' => 'email_access',
            ],
            [
                'id'   => 81,
                'name' => 'email_create',
            ],
            [
                'id'   => 82,
                'name' => 'email_update',
            ],
            [
                'id'   => 83,
                'name' => 'email_delete',
            ],
            [
                'id'   => 84,
                'name' => 'email_show',
            ],
        ];

        Permission::insert($permissions);
    }
}
