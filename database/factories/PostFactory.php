<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = \App\Models\Post::class;

    public function definition()
    {
        return [
            'user_id' => $this->faker->randomDigit(),
            'category_id' => $this->faker->randomDigit(),
            'title' => $this->faker->text($maxNbChars = 10),
            'description' => $this->faker->text($maxNbChars = 100),
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
        ];
    }
}
