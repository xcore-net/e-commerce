<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
       
        Permission::create(['name' => 'create product']);
        Permission::create(['name' => 'update product']);
        Permission::create(['name' => 'view product']);
        Permission::create(['name' => 'delete product']);

        
       
        Permission::create(['name' => 'view orders']);
       
        Permission::create(['name' => 'view payments']);

       $roleAdmin = Role::create(['name' => 'admin']);
       $roleAdmin->givePermissionTo(Permission::all());

       $productManager = Role::create(['name' => 'productManager']);
       $productManager->givePermissionTo(['create product', 'update product', 'view product','delete product']);
        
       $paymentManager = Role::create(['name' => 'paymentManager']);
       $paymentManager->givePermissionTo([ 'view payments']);
        
       $orderManager = Role::create(['name' => 'orderManager']);
       $orderManager->givePermissionTo([ 'view orders']);
        
       
       $shahed = User::factory()->create([
        'email' => 'shahd4@gmail.com',
        'password'=> '11112222'
       ]);
       $shahed->assignRole($roleAdmin);

       $shams = User::factory()->create([
        'email' => 'shams@gmail.com',
        'password'=>'33332222'
       ]);
       $shams->assignRole($productManager);

       $sham = User::factory()->create([
        'email' => 'sham@gmail.com',
        'password'=> '11112222'
       ]);
       $sham->assignRole($paymentManager);


       $shaza = User::factory()->create([
        'email' => 'shaza@gmail.com',
        'password'=> '11112222'
       ]);
       $shaza->assignRole($orderManager);



      //  $user = User::factory()->create([
      //   'email' => 'user@example.com',
      //  ]);
      //  $user->assignRole($roleUser);


    }
    }

