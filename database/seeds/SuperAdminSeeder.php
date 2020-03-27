<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $user = User::firstOrCreate(['id' => 1],[
            'first_name' => 'Abdullah',
            'last_name' => 'mohamed',
            'email' => 'admin@dev.com',
            'password' => Hash::make('admin123'),
            'phone' => '01187754669'
        ]);

        $role = Role::firstOrCreate(['name' => 'Admin', 'description' => 'Administrator']);

        $user->assignRole([$role->id]);

        Role::firstOrCreate(['name' => 'Staff', 'description' => 'Staff member']);
    }

}
