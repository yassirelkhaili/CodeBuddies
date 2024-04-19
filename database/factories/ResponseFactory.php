<?php

namespace Database\Factories;

use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reponse
 */
class ResponseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userRepository = app(UserRepositoryInterface::class);
        $postRepository = app(PostRepositoryInterface::class);

        $userIds = $userRepository->getAllNoPaginate()->pluck('id')->toArray();
        $postIds = $postRepository->getAllNoPaginate()->pluck('id')->toArray();

        return [
            'content' => $this->faker->paragraph,
            'answer' => 0,
            'votes' => $this->faker->numberBetween(0, 129),
            'user_id' => $this->faker->randomElement($userIds),
            'post_id' => $this->faker->randomElement($postIds),
        ];
    }
}
