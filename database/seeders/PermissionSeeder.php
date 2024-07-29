<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            //product
            'view-product',
            'create-product',
            'edit-product',
            'delete-product',
            //order
            'view-order',
            'view-all-order',
            'create-order',
            'edit-order',
            'delete-order',
            //payment
            'view-payment',
            'create-payment',
            'edit-payment',
            'delete-payment',
         ];
 
          // Looping and Inserting Array's Permissions into Permission Table
         foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
          }
    }
}