<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'user-view',
            'user-create',
            'user-edit',
            'user-delete',
            'role-view',
            'role-create',
            'role-edit',
            'role-delete',
            'product-view',
            'product-create',
            'product-edit',
            'product-delete',
            'reorder-message',
            'reorder-view',

        ];
       
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
