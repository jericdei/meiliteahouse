<?php

namespace Database\Seeders;

use App\Models\Investors\Investor;
use App\Models\Investors\InvestorSubmission;
use App\Models\Users\User;
use Database\Seeders\Auth\RolesAndPermissionsSeeder;
use Database\Seeders\Investor\ClassificationSeeder;
use Database\Seeders\Products\CategorySeeder;
use Database\Seeders\Products\ProductSeeder;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            ClassificationSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);

        // For testing
        User::factory(random_int(50, 100))->create()->each(
            fn (User $user) => $user->assignRole(
                Role::inRandomOrder()->first()->name
            )
        );

        $investors = Investor::factory(random_int(50, 100))
            ->create()
            ->each(fn (Investor $investor) => $investor->update([
                'referred_by' => fake()->boolean()
                    ? Investor::inRandomOrder()->first()->id
                    : null,
            ]));

        InvestorSubmission::factory(random_int(50, 100))->create();
    }
}
