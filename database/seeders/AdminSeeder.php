<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '911234567891',
            'gender' => 'FEMALE',
            'address' => 'Rajkot',
            'image' => '1700742370.png',
            'password' => Hash::make('admin@123')
        ]);

    }
}
