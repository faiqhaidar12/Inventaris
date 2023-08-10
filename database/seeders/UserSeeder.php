<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole('admin');

        $staff = User::create([
            'name' => 'staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $staff->assignRole('staff');
    }
}
