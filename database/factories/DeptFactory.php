<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class deptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'd_name' => 'IT',
            'd_active'=> 1
        ];
    }
}
