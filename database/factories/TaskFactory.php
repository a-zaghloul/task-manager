<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->word(),
            'description' => fake()->sentence(3),
            'due_date' => $dueDate = fake()->dateTimeBetween('tomorrow', '+1 year')->format('Y-m-d'),
            'completed' => $completed = fake()->boolean(),
            'completed_at' => $completed ? $dueDate : null,
        ];
    }
}
