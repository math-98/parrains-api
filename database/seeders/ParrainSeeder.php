<?php

namespace Database\Seeders;

use App\Models\Parrain;
use Illuminate\Database\Seeder;

class ParrainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parrain::factory()
                ->count(7)
                ->create();
        Parrain::factory()
                ->count(3)
                ->absent()
                ->create();
    }
}
