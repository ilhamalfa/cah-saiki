<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $this->faker->sentence(mt_rand(1,1)),
            'harga' => $this->faker->randomNumber(5, true),
            'jumlah' => $this->faker->randomNumber(2, true),
            'status' => 'Belum Habis',
        ];
    }
}
