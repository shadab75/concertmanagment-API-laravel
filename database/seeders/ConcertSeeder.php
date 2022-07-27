<?php

namespace Database\Seeders;

use App\Models\concert;
use Illuminate\Database\Seeder;

class ConcertSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        concert::factory()->count(10)->create();
    }
}
