<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => rtrim($this->faker->sentence(5,10), "."),
            'body' => $this->faker->paragraph(rand(3,7), true),
            'views' => $this->faker->numberBetween(0, 10),
//            'answers_count' => $this->faker->numberBetween(0, 10),
//            'votes_count' => $this->faker->numberBetween(-3, 10),
        ];
    }
}
