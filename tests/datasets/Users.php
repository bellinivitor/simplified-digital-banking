<?php

dataset('admin', [fn() => \App\Models\User::factory()->admin()->create()]);
dataset('user', [fn() => \App\Models\User::factory()->create()]);
