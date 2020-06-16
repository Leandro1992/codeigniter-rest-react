<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        DB::table('role_user')->truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'seller')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@cplug.com',
            'password' => Hash::make('password')
        ]);

        $seller = User::create([
            'name' => 'Vendedor',
            'email' => 'seller@cplug.com',
            'password' => Hash::make('password')
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@cplug.com',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $seller->roles()->attach($authorRole);
        $user->roles()->attach($userRole);
    }
}
