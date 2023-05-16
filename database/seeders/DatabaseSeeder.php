<?php

namespace Database\Seeders;

use Database\Seeders\Auth\RolesAndPermissionsSeeder;
use Database\Seeders\Investor\ClassificationSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            ClassificationSeeder::class
        ]);
    }
}
