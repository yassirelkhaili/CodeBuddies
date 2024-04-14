<?php

namespace App\Repositories;

use App\Models\Forum;
use App\Interfaces\ForumRepositoryInterface;

class ForumRepository implements ForumRepositoryInterface
{
    public function getById($id)
    {
        return Forum::findOrFail($id);
    }

    public function create(array $data)
    {
        return Forum::create($data);
    }

    public function update($id, array $data)
    {
        $Forum = $this->getById($id);
        $Forum->update($data);
        return $Forum;
    }

    public function delete($id)
    {
        $Forum = $this->getById($id);
        $Forum->delete();
    }

    public function countActiveForums($minutes = 5)
    {
        return Forum::where('last_activity', '>=', now()->subMinutes($minutes))->count();
    }

    public function getAll() {
        return Forum::orderBy('created_at', 'desc')->paginate(9);
    }    

    public function getAllNoPaginate() {
        return Forum::all();
    }

    public function search(string $searchInput) {
        return Forum::where('name', 'like', '%' . $searchInput . '%')->orderBy('created_at', 'desc')->paginate(9);
    }
}
