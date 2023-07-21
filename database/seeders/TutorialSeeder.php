<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Tutorial;
use Illuminate\Database\Seeder;

class TutorialSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        Tutorial::factory()->count(10)->create();
    }
}
