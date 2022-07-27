<?php

use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;



class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create(['name' => 'admin']);
        $user = User::first();
        $user->assignRole('admin');
    }
}
