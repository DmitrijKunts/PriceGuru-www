<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

class ReleaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $v = $this->faker->numberBetween(1, 99999);
        return [
            'version' => $v,
            'description' => $this->faker->name,
            'file_inst' => UploadedFile::fake()->create("file$v.exe", 2999),
            'file_arc' => UploadedFile::fake()->create("arc$v.zip", 2999),
        ];
    }
}
