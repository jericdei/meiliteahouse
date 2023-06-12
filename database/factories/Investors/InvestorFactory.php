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
        $occupation = array_rand(OccupationTypeEnum::array());

        return [
            'status' => array_rand(InvestorStatusEnum::array()),
            'referral_code' => Str::random(8),
            'referral_bonus' => 0,
            'age' => random_int(18, 65),
            'occupation_type' => $occupation,
            'occupation_data' => match ($occupation) {
                'student' => $this->generateSchoolData(),
                'working' => $this->generateCompanyData()
            },
            'valid_id' => fake()->filePath(),
            'user_id' => User::inRandomOrder()->first()->id,
            'classification_id' => null,
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
