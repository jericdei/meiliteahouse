<?php

namespace Database\Factories\Investors;

use App\Enums\Common\StatusEnum;
use App\Enums\Investors\OccupationTypeEnum;
use App\Enums\Transactions\PaymentMethodEnum;
use App\Models\Investors\Investor;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investors\InvestorSubmission>
 */
class InvestorSubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $occupation = fake()->randomElement(OccupationTypeEnum::values());
        $investorFactory = new InvestorFactory();

        return [
            'id' => fake()->uuid(),
            'status' => fake()->randomElement(StatusEnum::values()),
            'first_name' => fake()->firstName(),
            'middle_name' => fake()->lastName(),
            'last_name' => fake()->lastName(),
            'contact_no' => fake()->phoneNumber(),
            'email' => fake()->email(),
            'age' => random_int(18, 65),
            'referred_by' => fake()->boolean()
                ? Investor::inRandomOrder()->first()->id
                : null,
            'occupation_type' => $occupation,
            'occupation_data' => match ($occupation) {
                'student' => $investorFactory->generateSchoolData(),
                'working' => $investorFactory->generateCompanyData()
            },
            'investment_amount' => random_int(1000, 25000),
            'reference_no' => fake()->uuid(),
            'payment_method' => fake()->randomElement(PaymentMethodEnum::values()),
        ];
    }
}
