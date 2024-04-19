<?php

namespace Database\Seeders;

use App\Models\Post;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Thread;
use App\Models\Response;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ForumSeeder::class);
        Thread::factory()->count(50)->create();
        Post::factory()->count(200)->create();
        Response::factory()->count(300)->create();
    }
}
