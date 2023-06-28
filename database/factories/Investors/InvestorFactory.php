<?php

namespace Database\Factories\Investors;

use App\Enums\Investors\InvestorStatusEnum;
use App\Enums\Investors\OccupationTypeEnum;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Investors\Investor>
 */
class InvestorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $occupation = fake()->randomElement(OccupationTypeEnum::values());

        return [
            'status' => fake()->randomElement(InvestorStatusEnum::values()),
            'referral_code' => Str::random(8),
            'referral_bonus' => 0,
            'age' => random_int(18, 65),
            'occupation_type' => $occupation,
            'occupation_data' => match ($occupation) {
                'student' => $this->generateSchoolData(),
                'working' => $this->generateCompanyData()
            },
            'user_id' => User::inRandomOrder()->first()->id,
            'classification_id' => 1,
        ];
    }

    public function generateSchoolData(): array
    {
        return [
            'name' => fake()->company().' University',
            'address' => fake()->address(),
            'contactNo' => fake()->phoneNumber(),
            'courseYear' => 'Bachelor of Science in '.fake()->jobTitle(),
        ];
    }

    public function generateCompanyData(): array
    {
        return [
            'name' => fake()->company(),
            'address' => fake()->address(),
            'contactNo' => fake()->phoneNumber(),
            'position' => fake()->jobTitle(),
            'workYears' => random_int(1, 20),
        ];
    }
}
