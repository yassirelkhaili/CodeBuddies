<?php

namespace Database\Factories;

use App\Interfaces\ThreadRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userRepository = app(UserRepositoryInterface::class);
        $threadRepository = app(ThreadRepositoryInterface::class);

        $userIds = $userRepository->getAllNoPaginate()->pluck('id')->toArray();
        $threadIds = $threadRepository->getAllNoPaginate()->pluck('id')->toArray();

        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'user_id' => $this->faker->randomElement($userIds),
            'thread_id' => $this->faker->randomElement($threadIds),
        ];
    }
}
