<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resetToken = Str::random(32);
        
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@warta.id',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
            'is_active' => true,
            'reset_token' => $resetToken,
        ]);
    }
}
