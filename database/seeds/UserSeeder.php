<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name'  => 'Admin',
            'email' => 'admin@admin.com',
            'phone'  => '0570807590',
            'password' => Hash::make('12345678'),
            'blocked'  => '0',
        ]);
    }
}
