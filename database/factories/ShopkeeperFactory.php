<?php

namespace Database\Factories;

use App\Models\Identification;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shopkeeper>
 */
class ShopkeeperFactory extends Factory
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
            'cnpj' => $faker->cnpj(false),
            'identification_id' => Identification::factory(),
            'user_id' => User::factory(),
        ];
    }
}
