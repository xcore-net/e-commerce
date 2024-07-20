<?php

namespace Database\Seeders;

use App\Models\Billing;
use App\Models\Product;
use App\Models\User;
use App\Models\UserDetails;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(20)->create()->each(function($user){
            $billing = Billing::factory()->create();
            UserDetails::factory()->create(['user_id'=>$user->id,'billing_id'=>$billing->id]);
         });
        
        Product::factory()->count(50)->create();

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'odai',
        //     'email' => 'odaiten@gmail.com',
        //     'password' => '123456789',
        // ]);
    }
}
