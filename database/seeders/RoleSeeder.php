<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::createOrFirst(['name' => 'superAdmin']);
        $admin = Role::createOrFirst(['name' => 'Admin']);
        $user = Role::createOrFirst(['name' => 'User']);
        $productManager = Role::createOrFirst(['name' => 'productManager']); 
        $orderManager = Role::createOrFirst(['name' => 'orderManager']); 
        $paymentManager = Role::createOrFirst(['name' => 'paymentManager']); 

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
        ]);

        $user->givePermissionTo([
            'view-product',
            'view-order',
            'view-payment',
        ]);

        $productManager->givePermissionTo([
            'view-product',
            'create-product',
            'update-product',
            'delete-product'
        ]);

        $orderManager->givePermissionTo([
            'create-order',
            // 'update-order',
            'delete-order',
            'view-all-order'
        ]);

        $paymentManager->givePermissionTo([
            'create-payment',
            'delete-payment'
        ]);
    }
}