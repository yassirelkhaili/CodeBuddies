<?php

namespace App\Interfaces;

interface ThreadRepositoryInterface
{
    public function getById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function getAll();

    public function getAllNoPaginate();

    public function filterByForum(string $filterInput, int $forumId);

    public function getAllByForum(int $forumId);
}
