<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\StoreThreadRequest;
use App\Http\Requests\UpdateThreadRequest;
use App\Interfaces\ForumRepositoryInterface;
use App\Interfaces\ThreadRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ThreadController extends Controller
{
    protected ThreadRepositoryInterface $threadRepository;
    protected ForumRepositoryInterface $forumRepository;
    public function __construct(ThreadRepositoryInterface $threadRepository, ForumRepositoryInterface $forumRepository)
    {
        $this->threadRepository = $threadRepository;
        $this->forumRepository = $forumRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $results = $this->threadRepository->getAll();
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


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreThreadRequest $request)
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThreadRequest $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
