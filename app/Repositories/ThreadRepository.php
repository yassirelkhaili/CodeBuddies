<?php

namespace App\Repositories;

use App\Models\Thread;
use App\Interfaces\ThreadRepositoryInterface;

class ThreadRepository implements ThreadRepositoryInterface
{
    public function getById($id)
    {
        return Thread::findOrFail($id);
    }

    public function create(array $data)
    {
        return Thread::create($data);
    }

    public function update($id, array $data)
    {
        $Thread = $this->getById($id);
        $Thread->update($data);
        return $Thread;
    }

    public function delete($id)
    {
        $Thread = $this->getById($id);
        $Thread->delete();
    }

    public function countActiveThreads($minutes = 5)
    {
        return Thread::where('last_activity', '>=', now()->subMinutes($minutes))->count();
    }

    public function getAll() {
        return Thread::paginate(9);
    }

    public function getAllNoPaginate() {
        return Thread::all();
    }

    public function filter(string $searchInput) {
        return Thread::where('name', 'like', '%' . $searchInput . '%')->paginate(9);
    }
}
