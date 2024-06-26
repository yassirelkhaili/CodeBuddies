<?php

namespace App\Interfaces;

interface ForumRepositoryInterface
{
    public function getById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function getAll();

    public function getAllNoPaginate();

    public function search(string $searchInput);
}