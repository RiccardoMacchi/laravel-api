<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Esegui il seeder.
     */
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'rick.mac97@outlook.com',
            'name' => 'Riccardo',
            'password' => Hash::make('Portfolio404!'),
        ]);
    }
}
