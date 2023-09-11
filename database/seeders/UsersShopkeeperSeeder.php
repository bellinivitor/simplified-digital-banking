<?php

namespace Database\Seeders;

use App\Models\Shopkeeper;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersShopkeeperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(Shopkeeper::factory(), 'shopkeeper')
            ->count(5)
            ->create();
    }
}
