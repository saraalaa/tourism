<?php

namespace Database\Seeders;

use App\Models\City;
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
         \App\Models\Country::factory(10)->has(City::factory()->count(10))->create();
        $this->call(UserSeeder::class);

    }
}

