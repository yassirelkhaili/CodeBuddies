<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}