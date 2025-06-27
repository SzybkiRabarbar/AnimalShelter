<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Zones extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('zones')->insert([
            [
                'uuid' => Str::uuid(),
                'name' => 'East Poland'
            ],
            [
                'uuid' => Str::uuid(),
                'name' => 'West Poland'
            ],
        ]);
    }
}
