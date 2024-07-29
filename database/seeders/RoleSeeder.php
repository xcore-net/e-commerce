<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::createOrFirst(['name' => 'Super Admin']);
        $admin = Role::createOrFirst(['name' => 'Admin']);
        $user = Role::createOrFirst(['name' => 'User']);
        $productManager = Role::createOrFirst(['name' => 'Product Manager']); 
        $orderManager = Role::createOrFirst(['name' => 'Order Manager']); 
        $paymentManager = Role::createOrFirst(['name' => 'Payment Manager']); 

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
            'edit-product',
            'delete-product'
        ]);
        $orderManager->givePermissionTo([
            'create-order',
            'edit-order',
            'delete-order',
            'view-all-order'
        ]);
        $paymentManager->givePermissionTo([
            'create-payment',
            'edit-payment',
            'delete-payment'
        ]);
    }
}