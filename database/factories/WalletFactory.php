<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Wallet>
 */
class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'balance' => 0
        ];
    }

    public function withBalance(float $amount): WalletFactory|Factory
    {
        return $this->state(fn(array $attributes) => [
            'balance' => $amount
        ]);
    }


}
