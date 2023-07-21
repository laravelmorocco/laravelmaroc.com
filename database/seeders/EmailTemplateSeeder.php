<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplateSeeder extends Seeder
{
    public function run()
    {
        EmailTemplate::insert([
            [
                'name'         => 'Newsletter Template',
                'type'         => 'newsletter',
                'subject'      => 'Newsletter Subject',
                'description'  => 'This is a template for the newsletter.',
                'message'      => 'Dear {{name}}, welcome to our newsletter!',
                'default'      => true,
                'placeholders' => json_encode(['name', 'email']),
                'status'       => 'active',
            ],
            [
                'name'         => 'Order Confirmation Template',
                'type'         => 'order_confirmation',
                'subject'      => 'Order Confirmation Subject',
                'description'  => 'This is a template for order confirmation.',
                'message'      => 'Dear {{name}}, thank you for your order!',
                'default'      => false,
                'placeholders' => json_encode(['name', 'email', 'order_id']),
                'status'       => 'active',
            ],
        ]);
    }
}
