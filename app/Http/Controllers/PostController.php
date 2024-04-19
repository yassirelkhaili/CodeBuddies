<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Interfaces\PostRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostController extends Controller
{
    protected PostRepositoryInterface $postRepository;
    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function filter(Request $request, int $threadId): View | String
    {
        $filterInput = $request->input('query');
        $results = isset($filterInput)
            ? $this->postRepository->filterByThread($filterInput, $threadId)
            : $this->postRepository->getAllByThread($threadId);
        $viewTemplate = $request->ajax() ? "layouts.posts" : "forum-index";
        return view($viewTemplate, ["posts" => $results])->render();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $result = $this->postRepository->getById($id);
            $responses = $result->responses()->orderBy('created_at', 'desc')->paginate(9);
            return view("post")->with(["post" => $result, "responses" => $responses]);
        } catch (ModelNotFoundException $error) {
            return redirect()->back()->with('status', 'The requested post could not be found. ErrorCode: ' . $error);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
