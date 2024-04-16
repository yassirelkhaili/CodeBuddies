<?php

namespace App\Repositories;

use App\Models\Post;
use App\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface
{
    public function getById($id)
    {
        return Post::findOrFail($id);
    }

    public function create(array $data)
    {
        return Post::create($data);
    }

    public function update($id, array $data)
    {
        $Post = $this->getById($id);
        $Post->update($data);
        return $Post;
    }

    public function delete($id)
    {
        $Post = $this->getById($id);
        $Post->delete();
    }

    public function countActivePosts($minutes = 5)
    {
        return Post::where('last_activity', '>=', now()->subMinutes($minutes))->count();
    }

    public function getAll() {
        return Post::orderBy('created_at', 'desc')->paginate(9);
    }    

    public function getAllNoPaginate() {
        return Post::all();
    }

    public function filterByThread(string $filterInput, int $threadId)
    {
        return Post::where('thread_id', $threadId)
            ->where('title', 'like', '%' . $filterInput . '%')
            ->paginate(9);
    }

    public function getAllByThread(int $threadId)
    {
        return Post::where('thread_id', $threadId)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    }
}
