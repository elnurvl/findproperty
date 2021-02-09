<?php

namespace Database\Seeders;

use App\Models\House;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        House::factory(10)->create();
    }
}
