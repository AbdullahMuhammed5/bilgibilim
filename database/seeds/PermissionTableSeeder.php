<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list', 'role-create', 'role-edit', 'role-delete',
            'news-list', 'news-create', 'news-edit', 'news-delete',
            'city-list', 'city-create', 'city-edit', 'city-delete',
            'job-list', 'job-create', 'job-edit', 'job-delete',
            'staff-list', 'staff-create', 'staff-edit', 'staff-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }
    }
}
