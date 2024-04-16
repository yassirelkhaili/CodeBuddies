<?php

namespace App\Interfaces;

interface PostRepositoryInterface
{
    public function getById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function getAll();

    public function getAllNoPaginate();

    public function filterByThread(string $filterInput, int $threadId);

    public function getAllByThread(int $threadId);
}
