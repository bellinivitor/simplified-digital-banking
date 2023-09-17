<?php

use App\Models\Natural;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('teste', function(){
    try {
        User::factory()
            ->has(Natural::factory()->state(fn (array $attributes) => [
                'cpf' => '000.000.000.00',
            ]))
            ->count(2)
            ->create();
    }catch (Exception $exception){
        dd($exception);
    }
});
