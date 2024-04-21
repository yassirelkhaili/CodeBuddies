<?php

namespace App\Repositories;

use App\Models\Response;
use App\Interfaces\ResponseRepositoryInterface;

class ResponseRepository implements ResponseRepositoryInterface
{
    public function getById($id)
    {
        return Response::findOrFail($id);
    }

    public function create(array $data)
    {
        return Response::create($data);
    }

    public function update($id, array $data)
    {
        $Response = $this->getById($id);
        $Response->update($data);
        return $Response;
    }

    public function delete($id)
    {
        $Response = $this->getById($id);
        $Response->delete();
    }

    public function countActiveResponses($minutes = 5)
    {
        return Response::where('last_activity', '>=', now()->subMinutes($minutes))->count();
    }

    public function getAll()
    {
        return Response::orderBy('created_at', 'desc')->paginate(9);
    }

    public function getAllNoPaginate()
    {
        return Response::all();
    }

    public function filterByThread(string $filterInput, int $threadId)
    {
        return Response::where('thread_id', $threadId)
            ->where('title', 'like', '%' . $filterInput . '%')
            ->paginate(9);
    }

    public function getAllByThread(int $threadId)
    {
        return Response::where('thread_id', $threadId)
            ->orderBy('created_at', 'desc')
            ->paginate(9);
    }

    public function getResponsesByPost(int $postId)
    {
        return Response::where('post_id', $postId)->orderBy('votes', 'desc')->orderBy('created_at', 'desc')->paginate(9);
    }

    public static function isAnswerMarked(int $postId)
    {
        return Response::where('post_id', $postId)->where('answer', 1)->exists();
    }
}
