<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $hostIds = User::pluck('id')->toArray();
        return [
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'user_id' => fake()->randomElement($hostIds), // Randomly select a host id
        ];
    }
}
