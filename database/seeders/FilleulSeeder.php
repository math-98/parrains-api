<?php

namespace Database\Seeders;

use App\Models\Filleul;
use Illuminate\Database\Seeder;

class FilleulSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Filleul::factory()
            ->count(10)
            ->create();
        Filleul::factory()
            ->count(5)
            ->absent()
            ->create();
    }
}
