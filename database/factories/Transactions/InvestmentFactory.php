<?php

namespace Database\Factories\Transactions;

use App\Enums\Common\StatusEnum;
use App\Enums\Transactions\PaymentMethodEnum;
use App\Models\Investors\Investor;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transactions\Investment>
 */
class InvestmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => fake()->randomFloat(2, 1000, 30000),
            'status' => fake()->randomElement(StatusEnum::values()),
            'payment_method' => fake()->randomElement(PaymentMethodEnum::values()),
            'reference_no' => Str::random(10),
            'investor_id' => Investor::inRandomOrder()->first()->id,
        ];
    }
}
