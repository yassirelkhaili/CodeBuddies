<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Interfaces\ForumRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\ThreadRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ThreadController extends Controller
{
    protected ThreadRepositoryInterface $threadRepository;
    protected ForumRepositoryInterface $forumRepository;
    protected PostRepositoryInterface $postRepository;
    public function __construct(PostRepositoryInterface $postRepository, ThreadRepositoryInterface $threadRepository, ForumRepositoryInterface $forumRepository)
    {
        $this->postRepository = $postRepository;
        $this->threadRepository = $threadRepository;
        $this->forumRepository = $forumRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(int $threadId): View
    {
        $results = $this->postRepository->getAllByThread($threadId);
        return view('posts', ["posts" => $results]);
    }

    public function filter(Request $request, int $forumId): View | String
    {
        $filterInput = $request->input('query');
        $results = isset($filterInput)
            ? $this->threadRepository->filterByForum($filterInput, $forumId)
            : $this->threadRepository->getAllByForum($forumId);
        $viewTemplate = $request->ajax() ? "layouts.threads" : "forum-index";
        return view($viewTemplate, ["threads" => $results])->render();
    }

    public function fetchThread(int $threadId)
    {
        try {
            $threadDescription = $this->threadRepository->getById($threadId)->description;
            $threadTitle = $this->threadRepository->getById($threadId)->name;
            return response()->json(["title" => $threadTitle, "content" => $threadDescription]);
        } catch (ModelNotFoundException $error) {
            return response()->json("The requested thread could not be found. ErrorCode: $error");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadRequest $request): view | string
    {
        $description = $request->input('description');
        $name = $request->input('name');
        $forumId = $request->input('forum_id');
        $this->threadRepository->create(['description' => $description, 'name' => $name, 'forum_id' => $forumId, 'user_id' => auth()->user()->id]);
        $threads = $this->threadRepository->getAllByForum($forumId);
        $viewTemplate = $request->ajax() ? "layouts.threads" : "forum-index";
        return view($viewTemplate, ["threads" => $threads])->render();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $result = $this->threadRepository->getById($id);
            $posts = $result->posts()->orderBy('created_at', 'desc')->paginate(9);
            return view("thread")->with(["thread" => $result, "posts" => $posts]);
        } catch (ModelNotFoundException $error) {
            return redirect()->back()->with('status', 'The requested thread could not be found. ErrorCode: ' . $error);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadRequest $request, int $threadId)
    {
        $description = $request->input('description');
        $name = $request->input('name');
        $this->threadRepository->update($threadId, ['description' => $description, 'name' => $name]);
        $thread = $this->threadRepository->getById($threadId);
        $threads = $this->threadRepository->getAllByForum($thread->forum->id);
        $viewTemplate = $request->ajax() ? "layouts.threads" : "forum-index";
        return view($viewTemplate, ["threads" => $threads])->render();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $threadId)
    {
        $thread = $this->threadRepository->getById($threadId);
        $this->threadRepository->delete($threadId);
        $threads = $this->threadRepository->getAllByForum($thread->forum->id);
        $viewTemplate = $request->ajax() ? "layouts.threads" : "forum-index";
        return view($viewTemplate, ["threads" => $threads])->render();
    }
}
