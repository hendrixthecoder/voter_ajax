<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Jimmy Neuton',
            'email' => 'jimmyneutron@gmail.com',
            'ip' => '236.111.83.151'
        ]);

        User::create([
            'name' => 'Sandy Cheeks',
            'email' => 'sanyclapper@gmail.com',
            'ip' => '126.43.192.4'
        ]);

        User::create([
            'name' => 'Patrick Star',
            'email' => 'pactrickstar@gmail.com',
            'ip' => '140.228.221.233'
        ]);
        
    }
}
