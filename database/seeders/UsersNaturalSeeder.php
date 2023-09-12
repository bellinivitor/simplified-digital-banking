<?php

namespace Database\Seeders;

use App\Models\Natural;
use App\Models\Shopkeeper;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersNaturalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(Natural::factory()->has(Wallet::factory()), 'natural')
            ->count(5)
            ->create();
    }
}
