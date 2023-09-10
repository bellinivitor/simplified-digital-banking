<?php

namespace Database\Factories;

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
            'cpf' => $faker->cpf
        ];
    }
}
