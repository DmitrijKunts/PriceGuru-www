<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LicDownloadHistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'date' => $this->faker->date(),
        ];
    }
}
