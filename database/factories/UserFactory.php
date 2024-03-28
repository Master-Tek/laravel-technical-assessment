<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        return [
            'firstName' => $this->faker->firstName(),
            'lastName' => $this->faker->lastName(),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'country' => $this->faker->country(),
            'dateOfBirth' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
            'married' => false,
            'dateOfMarriage' => null,
            'marriageCountry' => null,
            'widowed' => false,
            'marriedInPast' => false,
        ];
    }

    public function married(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'married' => true,
                'dateOfMarriage' => $this->faker->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
                'marriageCountry' => $this->faker->country(),
            ];
        });
    }

    public function unmarried(): Factory
    {
        return $this->state(function (array $attributes) {
            return [
                'married' => false,
                'widowed' => true,
                'marriedInPast' => true,
            ];
        });
    }
}
