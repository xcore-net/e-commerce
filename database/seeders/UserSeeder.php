<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'super user',
            'email' => 'super@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        $superAdmin->assignRole('superAdmin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'Syed Ahsan Kamal',
            'email' => 'ahsan@allphptricks.com',
            'password' => Hash::make('ahsan1234')
        ]);
        $admin->assignRole('admin');

        // Creating Product Manager User
        $productManager = User::create([
            'name' => 'product Manager',
            'email' => 'productManager@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        $productManager->assignRole('productManager');

        // Creating Order Manager User
        $orderManager = User::create([
            'name' => 'Order Manager',
            'email' => 'orderManager@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        $orderManager->assignRole('orderManager');

        // Creating Payments Manager User
        $paymentManager = User::create([
            'name' => 'payment Manager',
            'email' => 'paymentManager@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        $paymentManager->assignRole('paymentManager');

        // Creating Application User
        $user = User::create([
            'name' => 'Naghman Ali',
            'email' => 'naghman@allphptricks.com',
            'password' => Hash::make('naghman1234')
        ]);
        $user->assignRole('user');
    }
}
