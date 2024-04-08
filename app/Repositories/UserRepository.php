<?php

namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->getById($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->getById($id);
        $user->delete();
    }

    public function countActiveUsers($minutes = 5)
    {
        return User::where('last_activity', '>=', now()->subMinutes($minutes))->count();
    }
}
