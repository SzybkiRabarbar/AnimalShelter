<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Shelter;

class Schelters extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shelter::create([
            'uuid' => Str::uuid(),
            'name' => 'City Animal Haven',
            'zone_id' => 1,
            'open_hour' => '09:00:00',
            'close_hour' => '17:00:00',
        ]);

        Shelter::create([
            'uuid' => Str::uuid(),
            'name' => 'Green Valley Shelter',
            'zone_id' => 2,
            'open_hour' => '10:00:00',
            'close_hour' => '18:00:00',
        ]);

        Shelter::create([
            'uuid' => Str::uuid(),
            'name' => 'Riverside Animal Care',
            'zone_id' => 2,
            'open_hour' => '08:30:00',
            'close_hour' => '16:30:00',
        ]);
    }
}
