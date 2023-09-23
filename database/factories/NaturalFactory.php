<?php

namespace Database\Factories;

use App\Models\Identification;
use App\Models\User;
use Faker\Provider\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Natural>
 */
class NaturalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('pt_BR');
        return [
            'cpf' => $faker->cpf(false),
            'identification_id' => Identification::factory(),
            'user_id' => User::factory(),
        ];
    }
}
