<?php

namespace Database\Factories;
use App\Models\UserDetail;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    //protected $model = UserDetail::class;

    public function definition()
    {
    //     return [
    //         'phone' => $this->faker->RandomNumber->phone,
    //         'address' => $this->faker->address,
    //         'user_id' => function () {
    //             return \App\Models\User::factory()->create()->id;
    //         },
    //         'billing_id' => function () {
    //             return \App\Models\Billing::factory()->create()->id;
    //         },
    //     ];
     }
}
