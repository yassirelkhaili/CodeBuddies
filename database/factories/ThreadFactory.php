<?php

namespace Database\Factories;

use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\ForumRepositoryInterface;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userRepository = app(UserRepositoryInterface::class);
        $forumRepository = app(ForumRepositoryInterface::class);

        $userIds = $userRepository->getAllNoPaginate()->pluck('id')->toArray();
        $forumIds = $forumRepository->getAllNoPaginate()->pluck('id')->toArray();

        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'user_id' => $this->faker->randomElement($userIds),
            'forum_id' => $this->faker->randomElement($forumIds),
            'is_active' => true
        ];
    }
}
