<?php

use App\Models\Natural;
use App\Models\Shopkeeper;
use App\Models\Wallet;

dataset('admin', [fn() => \App\Models\User::factory()->admin()->create()]);
dataset('user', [fn() => \App\Models\User::factory()->create()]);
