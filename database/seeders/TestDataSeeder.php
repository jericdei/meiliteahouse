<?php

namespace Database\Seeders;

use App\Models\Investors\Investor;
use App\Models\Investors\InvestorSubmission;
use App\Models\Transactions\Investment;
use App\Models\Users\User;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For testing
        User::factory()
            ->count(random_int(10, 20))
            ->create()
            ->each(
                fn (User $user) => $user->assignRole('investor')
            );

        Investor::factory()
            ->count(random_int(10, 20))
            ->create()
            ->each(fn (Investor $investor) => $investor->update([
                'referred_by' => fake()->boolean()
                    ? Investor::inRandomOrder()->first()->id
                    : null,
            ]));

        Investment::factory()
            ->count(random_int(20, 30))
            ->create();

        InvestorSubmission::factory()
            ->count(random_int(20, 30))
            ->create();
    }
}
