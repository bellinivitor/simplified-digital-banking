<?php

namespace Database\Seeders;

use App\Models\Identification;
use App\Models\Shopkeeper;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersShopkeeperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shopkeeper::factory()
            ->has(Wallet::factory())
            ->count(5)
            ->create();
    }
}
