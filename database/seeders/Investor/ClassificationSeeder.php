<?php

namespace Database\Seeders\Investor;

use App\Models\Investors\Classification;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classifications = [
            [
                'title' => 'Basic',
                'total_investment' => 1000.00,
                'interest_rate' => config('investment.interest_rate'),
                'referral_rate' => 0,
            ],
            [
                'title' => 'Bronze',
                'total_investment' => 5000.00,
                'interest_rate' => config('investment.interest_rate'),
                'referral_rate' => 0.025,
            ],
            [
                'title' => 'Silver',
                'total_investment' => 7500.00,
                'interest_rate' => config('investment.interest_rate'),
                'referral_rate' => 0.05,
            ],
            [
                'title' => 'Gold',
                'total_investment' => 10000.00,
                'interest_rate' => config('investment.interest_rate'),
                'referral_rate' => 0.075,
                'freebies' => [
                    'certificate_with_contract' => true,
                ],
            ],
            [
                'title' => 'Diamond',
                'total_investment' => 25000.00,
                'interest_rate' => config('investment.interest_rate'),
                'referral_rate' => 0.1,
                'freebies' => [
                    'certificate_with_contract' => true,
                    'diamond_merchandise_package' => true,
                    'cart_branch_eligible' => true,
                ],
            ],
        ];

        foreach ($classifications as $classification) {
            Classification::create($classification);
        }
    }
}
